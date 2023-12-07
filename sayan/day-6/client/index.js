const table=document.getElementById('table')
const apiUrl = "http://localhost/infovue/sayan/day_4/server/api.php";
Setdata();

 
async function Setdata(){
const resp= await fetch(apiUrl)
const data= await resp.json()

data?.data.forEach(element => {
    table.innerHTML+=Dataformat(element);
});

data?.data.forEach(element => {
    document.getElementById("delete"+element.id).addEventListener('click',async ()=>{
        console.log("first")
        await Delete(element.id);
        document.getElementById(element.id)?.remove();
    })
});

}  


async function Delete(itemId){

await fetch(`${apiUrl}?id=${itemId}`, {
  method: 'DELETE',
  headers: {
    'Content-Type': 'application/json',
  },
})



}


function Dataformat(data){
    return `<tr id=${data.id}>
    <td>${data.id}</td>
    <td>${data.name}</td>
    <td>${data.status>0?'done':'pending'}</td>
    <td>
        <button class="btn btn-primary">Edit</button>
        <button class="btn btn-danger" id=${"delete"+data.id}>Delete</button>
    </td>
</tr>`
}