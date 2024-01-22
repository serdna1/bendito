const addTextForm = document.getElementById('add-text-form')
const editorTextInput = document.getElementById('editor-text-input')
const boldButton = document.getElementById('bold-button')
const pdfButton = document.getElementById('pdf-button')
const jsonButton = document.getElementById('json-button')

let selectedText = null // Only will apply bold to the selected text

var stage = new Konva.Stage({
  container: 'container',
  width: 794,
  height: 1123,
})

var layer = new Konva.Layer()

stage.add(layer)

// Border that will surround the selected text
var selectionRect = new Konva.Rect({
  stroke: 'black',
  strokeWidth: 1,
})

layer.add(selectionRect)

// callback used for placing the input text on the stage
const onSubmit = (e) => {
  e.preventDefault()

  var newText = new Konva.Text({
    x: 50,
    y: 50,
    text: editorTextInput.value,
    fontSize: 20,
    fontFamily: 'Arial',
    fill: 'black',
    draggable: true,
  })

  // When the created text is dragged, the selection border will follow it
  newText.on('dragmove', (e) => {
    selectionRect.setAttr('x', e.target.attrs.x-10)
    selectionRect.setAttr('y', e.target.attrs.y-10)
  })
  
  layer.add(newText)
}

const removeSelection = () => {
  selectedText = null
  selectionRect.x(-500)
  selectionRect.y(-500)
}

// On mousedown, if the cursor is over a text makes it the new selected one.
// If it is over another part of the stage removes the previous selection 
const onMouseDown = () => {
  var pos = stage.getPointerPosition()
  var text = stage.getIntersection({x: pos.x, y: pos.y})

  if (text && text.getParent() === layer) {
    selectedText = text

    selectionRect.x(text.x()-10)
    selectionRect.y(text.y()-10)
    selectionRect.width(text.width()+20)
    selectionRect.height(text.height()+20)
  } else {
    removeSelection()
  }
}

const toggleBold = () => {
  if (!selectedText)
    return
  
  if (selectedText.fontStyle() === 'bold')
    selectedText.fontStyle('normal')
  else if (selectedText.fontStyle() === 'normal')
    selectedText.fontStyle('bold')
}

const downloadPDF = () => {
  removeSelection()
  
  var pdf = new jsPDF('p', 'pt', [stage.width(), stage.height()])
  
  pdf.setTextColor('#000000')
  
  // first add texts
  stage.find('Text').forEach((text) => {
    const size = text.fontSize()
    pdf.setFontSize(size)
    pdf.text(text.text(), text.x(), text.y(), {
      baseline: 'top',
      angle: -text.getAbsoluteRotation(),
      renderingMode: 'invisible'
    })
  })

  // then put image on top of texts (so texts are selectable and but keep the styling)
  pdf.addImage(
    stage.toDataURL({ pixelRatio: 2 }),
    0,
    0,
    stage.width(),
    stage.height()
  );

  pdf.save('canvas.pdf');
}

const downloadJSON = () => {
  removeSelection()
  var stageJSON = stage.toJSON()
  console.log(stageJSON);
  var dataStr = 'data:text/json;charset=utf-8,' + encodeURIComponent(JSON.stringify(stageJSON))
  var downloadAnchor = document.createElement('a')
  downloadAnchor.setAttribute('href', dataStr)
  downloadAnchor.setAttribute('download', 'canvas.json')
  document.body.appendChild(downloadAnchor) // required for firefox
  downloadAnchor.click()
  downloadAnchor.remove()
}

// Event declarations
addTextForm.addEventListener('submit', onSubmit)
stage.on('mousedown', onMouseDown)
boldButton.addEventListener('click', toggleBold)
pdfButton.addEventListener('click', downloadPDF)
jsonButton.addEventListener('click', downloadJSON)


