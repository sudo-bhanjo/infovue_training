const addBtn = document.getElementById('addTask')
const taskListHtml = document.getElementById('upcoming-task')
const taskname = document.getElementById('taskname')
const taskdesc = document.getElementById('taskdesc')
const members = document.querySelectorAll("#member")
const taskStatus = document.getElementById('TaskStatus')
const budget = document.getElementById('taskbudget')
const taskList=[]

class task {
    constructor(id = "", title = "", desc = "", members = [], status = "pending", budget = 0) {
        this.id = id
        this.title = title
        this.desc = desc
        this.members = members
        this.status = status
        this.budget = budget
    }
}

const taskHtml = (task) => {
    return `
    <div class="card task-box" id=${task.id}>
    <div class="card-body">
        <div class="dropdown float-end">
            <a href="#" class="dropdown-toggle arrow-none" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-dots-vertical m-0 text-muted h5"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item edittask-details" href="#" id="taskedit" data-id="#uptask-2" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Edit</a>
                <a class="dropdown-item deletetask" role="button" data-id="#uptask-2" id='delete-${task.id}'>Delete</a>
            </div>
        </div> <!-- end dropdown -->
        <div class="float-end ml-2">
            <span class="badge rounded-pill badge-soft-primary font-size-12" id="task-status">${task.status}</span>
        </div>
        <div>
            <h5 class="font-size-15"><a href="javascript: void(0);" class="text-dark" id="task-name">${task.title}</a></h5>
            <p class="text-muted">15 Oct, 2019</p>
        </div>
        
        <div class="ps-3 mb-4 text-muted" id="task-desc">
    ${task.id}

            ${task.desc}
        </div>

        <div class="avatar-group float-start task-assigne">
        ${task.members.map((element, index) => {
        return `
            <div class="avatar-group-item">
            <a href="javascript: void(0);" class="d-inline-block" value="member-1">
                <img src="assets/images/users/avatar-${index+1}.jpg" alt="" class="rounded-circle avatar-xs">
            </a>
        </div>`
        })}
        </div>
        <div class="text-end">
            <h5 class="font-size-15 mb-1" id="task-budget">$ ${task.budget}</h5>
            <p class="mb-0 text-muted">Budget</p>
        </div>
    </div>
    
</div>`
}


addBtn.addEventListener('click', (e) => {
    e.preventDefault()
    let newMembers=[]
    members.forEach(element => {
        if(element.checked)
        newMembers.push(element.value)
    });

    const newTask=new task(taskList.length.toString(),taskname.value,taskdesc.value,newMembers,taskStatus.value,budget.value)
    taskListHtml.innerHTML += taskHtml(newTask)
    taskList.push(newTask)
    console.log(newTask.id)
    const del=document.getElementById('delete-'+newTask.id)
    console.log(del)
    del.id=newTask.id
    del.addEventListener('click',(e)=>{
        e.preventDefault()
        console.log(e.currentTarget.id)
        const todo=document.getElementById(e.currentTarget.id)
        console.log(del)
        todo.remove()
    })


})