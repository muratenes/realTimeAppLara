template>
    <div class="row">
        <div class="col-md-6">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Başlık</th>
                    <th scope="col">İşlem</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="task in taskList">
                        <th scope="row">{{ task.id }}</th>
                        <td>{{ task.title }}</td>
                        <td><button @click="deleteTask(task.id)" type="button" class="btn btn-danger">Sil</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <form action="#" @submit.prevent="createTask()">
                <div class="form-group">
                    <label for="taskTitle">Yapılacak işin başlığı</label>
                    <input v-model="newTask.title" type="text" class="form-control" id="taskTitle" placeholder="Başlık">
                </div>
                <button type="submit" class="btn btn-primary">Ekle</button>
            </form>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                newTask: {
                    title: ''
                },
                taskList: []
            };
        },

        created() {
            this.getTasks();
        },

        methods: {
            getTasks() {
                axios.get('/tasks').then((res) => {
                    this.taskList = res.data;
                });
            },
            createTask() {
                axios.post('/tasks', this.newTask).then((res) => {
                    this.newTask.title = '';
                    this.getTasks();
                });

            },
            deleteTask(id) {
                axios.delete('/tasks/' + id).then((res) => {
                    this.getTasks();
                });
            }
        },
    }
</script>
