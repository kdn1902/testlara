<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <button  class="btn btn-primary btn-xs pull-right" @click="initAddDept()">
                            + Новый отдел
                    </button>
                    Отделы</div>
 
                    <div class="panel-body">
 				      <table class="table table-bordered table-striped table-responsive" v-if="depts.length > 0">
                            <tbody>
                                <tr>
                                    <th>Название отдела</th>
                                    <th>Родительский отдел</th>
                                    <th></th>
                                </tr>
                                <tr v-for="(dept, index) in depts">
                                    <td>{{ dept.name }}</td>
                                    <td>{{ dept.department_parent_name }}</td>
                                    <td>
                                        <button class="btn btn-success btn-xs" @click="initUpdateDept(index)">Редактировать</button>
                                        <button class="btn btn-danger btn-xs" @click="deleteDept(index)">Удалить</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" tabindex="-1" role="dialog" id="add_dept_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Новый отдел</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" v-if="deptserrors">
                            <ul>
                                <li v-for="value in deptserrors">{{ value[0] }}</li>
                            </ul>
                        </div>
 
                        <div class="form-group">
                           <label for="name">Название:</label>
                           <input type="text" name="name" id="name" placeholder="Название отдела" class="form-control" v-model="dept.name">
                        </div>
                        <div class="form-group">
                        <label>Родительский отдел</label>
                       <select v-model="current_parent" class="form-control">
  							<option v-for="depart in departments" v-bind:value="{ id: depart.department_number, name: depart.name }">
    								{{ depart.name }}
  							</option>
						</select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        <button type="button" @click="createDept" class="btn btn-primary">Создать отдел</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" tabindex="-1" role="dialog" id="update_dept_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Изменение отдела</h4>
                    </div>
                    <div class="modal-body">
 
                        <div class="alert alert-danger" v-if="deptserrors">
                            <ul>
                                <li v-for="value in deptserrors">{{ value[0] }}</li>
                            </ul>
                        </div>
 
                        <div class="form-group">
                            <label>Название</label>
                            <input type="text" placeholder="Название" class="form-control" v-model="update_dept.name">
                        </div>
                        <div class="form-group">
                        <label>Родительский отдел</label>
                       <select v-model="current_parent" class="form-control">
  							<option v-for="depart in departments" v-bind:value="{ id: depart.department_number, name: depart.name }">
    								{{ depart.name }}
  							</option>
						</select>
						</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        <button type="button" @click="updateDept" class="btn btn-primary">Изменить отдел</button>
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
</template>
 
<script>
    export default {
        data(){
            return {
                dept: {
                	id: '',
                    name: '',
                    department_number:'',
                    department_parent_number: '',
                    department_parent_name: ''
                },
                deptserrors: null,
                depts:[],
                update_dept: {},
                current_parent : {},
                departments: []
            }
        },
    	methods:{
    		initUpdateDept(index){
    			this.get_depts();
    			this.deptserrors = null;
       			this.update_dept = Object.assign({}, this.depts[index]);
    			this.current_parent.id = this.depts[index].department_parent_number;
    			this.current_parent.name = this.depts[index].department_parent_name;
    			$("#update_dept_model").modal("show");				
			},
    		initAddDept()
            {
            	this.get_depts()
            	this.dept.name="";
            	this.current_parent.id={};
                this.deptserrors = null;
                $("#add_dept_model").modal("show");
            },
    		deleteDept(index)
    		{
    			let conf = confirm(`Удалить отдел "` + this.depts[index].name + `"`);
                if (conf === true) {
                    axios.delete('/dept/' + this.depts[index].id)
                        .then(response => {
                        	this.depts.splice(index, 1);
 	                    })
 	                    .catch(error => {
 	                    	 alert("Ошибка: " + error.response.data.errors.message );
 							 console.log("Error delete department " + this.depts[index].name);
                        });
                }
			},
			createDept()
			{
				axios.post('/dept', {
                   name: this.dept.name,
                   parent_number: this.current_parent.id
                }).then(response => {
                    this.depts = response.data.depts;
                    $("#add_dept_model").modal("hide");
                }).catch(error => {
    	               if (error.response.data.errors) {
                            this.deptserrors = error.response.data.errors;
           	          }
                });
                
			},
			readDepts()
            {
                axios.get('/dept')
                    .then(response => {
                        this.depts = response.data.depts;
                     });
            
            },
            updateDept()
            {
				axios.patch('/dept/' + this.update_dept.id, {
                   name: this.update_dept.name,
                   parent_number: this.current_parent.id,
                }).then(response => {
                    this.depts = response.data.depts;
                    $("#update_dept_model").modal("hide");
                }).catch(error => {
    	               if (error.response.data.errors) {
                            this.deptserrors = error.response.data.errors;
           	          }
                });
				
			},
			get_depts(){
				axios.get('/getdepartments')
				.then( response =>  {
  					   this.departments = response.data;
  				})
  				.catch(error => {
    					console.log(error);
  				});
			}
		},
        mounted() {
 				this.readDepts();
        }
    }
</script>