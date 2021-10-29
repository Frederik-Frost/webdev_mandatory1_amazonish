function _one(q,from=document){return from.querySelector(q)}
function _all(q,from=document){return from.querySelectorAll(q)}
let deleteEvent = null
let itemId = null
let itemList = [];


window.addEventListener('DOMContentLoaded', () => {
    console.log("object")
    getItems();
})

async function getItems(){
    let response = await fetch('api/api-fetch-items')
    let items = await response.json()
    items.forEach(item => {
        addToList(item)
    })
}   
async function uploadItem(){
    const form = event.target
    let conn = await fetch('api/api-upload-item',{
        method: 'POST',
        body: new FormData(form)
    })
    const res = await conn.text()
    const itemName = _one("form .nameInput")
    const itemPrice = _one("form .priceInput")
    
    if(conn.ok){
        addToList({item_id: res, item_name: itemName.value, item_price: itemPrice.value ? itemPrice.value : 00 })
        itemName.value = ''
        itemPrice.value = ''
        itemName.focus()
    } 
}

async function deleteItem(){
    deleteEvent.target.parentElement.remove()
    const conn = await fetch('api/api-delete-item?item_id='+ itemId,{
        method: 'DELETE'
    })
    const res = await conn.text()
    deleteEvent = null
    itemId = null
    _one("#deleteModal").style.display = 'none';
    console.log(res)
}

function addToList(data){
    itemList.push(data)
    const itemElement = `<tr class="item">
                            <td class="id">${data.item_id}</td>
                            <td>${data.item_name}</td>
                            <td>${data.item_price}</td>
                            <td onclick="onUpdateItem()" data-id="${data.item_id}" data-name="${data.item_name}" data-price="${data.item_price}" class="updateItem"><i class="fas fa-pen"></i></i></td>
                            <td onclick="onDeleteItem()" data-id="${data.item_id}" data-name="${data.item_name}" class="deleteItem"><i class="far fa-trash-alt"></i></td>
                            <td data-id="${data.item_id}" data-name="${data.item_name}" class="bulk-action">  
                                <input type="checkbox" id="selectedID[${data.item_id}]" class="idCheckbox" value="${data.item_id}"> 
                            </td>
                        </tr>`
    _one("#items").insertAdjacentHTML("beforeend", itemElement)
} 

function onDeleteItem(){
    deleteEvent = event
    itemId = event.target.getAttribute('data-id')
    _one("#deleteModal p").innerText = `Really delete ${event.target.getAttribute('data-name')} from product list?`
    _one("#deleteModal").style.display = 'block';
}
    
function onUpdateItem(){
    let item = itemList.find(item => (item.item_id == event.target.getAttribute('data-id')))
    // itemId = item.item_id
    _one("#updateModal p").innerText = `Updating ${item.item_name}`
    _one("#updateModal .nameInput").value = item.item_name
    _one("#updateModal .priceInput").value = item.item_price       
    _one("#updateModal .idInput").value = item.item_id
    _one("#updateModal").style.display = 'block';
}
async function updateItem(){
    // const itemData = {
    //     item_id : itemId,
    //     item_name : _one("#updateModal .nameInput").value,
    //     item_price : _one("#updateModal .priceInput").value
    // }
    const form = event.target
    let conn = await fetch('api/api-update-item',{
        method: 'POST',
        // body: JSON.stringify(itemData)
        body: new FormData(form)
    })
    let res = await conn.json()
    console.log(res)
    console.log(conn)
    if(conn.ok){
        itemList = []
        _all(".item").forEach(itemNode => {
            console.log(itemNode)
            itemNode.remove();
        });
        getItems();
        _one("#updateModal").style.display = 'none';
        // itemId = null
    }
}
function cancel(){
    if(!event.target.form && !event.target.classList.contains('modalContent') && !event.target.parentElement.classList.contains('modalContent') || event.target.classList.contains('cancelBtn') ){
        _all(".modal").forEach(e => {
            e.style.display = 'none';
        });
        deleteEvent = null
        itemId = null
    }    
}

function onDeleteMultiple(){
    itemIdList = 0
    _all("#hiddenInputs input").forEach(staged => {
        staged.remove();
    })
    _all(".idCheckbox").forEach(id => {
        if(id.checked){
            itemIdList ++;
            const idInput = `<input type="hidden" name="delete_item[]" value="${id.value}">`
            _one("#hiddenInputs").insertAdjacentHTML("beforeend", idInput)
        }
    })
    _one("#deleteMultipleModal p").innerText = `You are about to delete ${itemIdList} ${itemIdList != 1 ? 'items' : 'item'}`
    _one("#deleteMultipleModal").style.display = 'block';
}

async function deleteItems() {
    const form = event.target.form
    let conn = await fetch('api/transaction',{
        method: 'POST',
        body: new FormData(form)
    })
    let res = await conn.text()
        console.log(res)
        console.log(conn)
    if(conn.ok){
        itemList = []
        _all(".item").forEach(itemNode => {
            itemNode.remove();
        });
        getItems();
        _one("#deleteMultipleModal").style.display = 'none';
    }
}