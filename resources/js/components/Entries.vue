<template>
    <div class="container">
        <timer :projects="projects"></timer>
        <div class="row justify-content-center">
                <table class="table table-bordered">
            <thead>
                <tr>
                <th scope="col">Title</th>
                <th scope="col">Project</th>
                <th scope="col">Start</th>
                <th scope="col">End</th>
                <th scope="col">Duration</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="event in entries">
                <th scope="row">{{ event.title }}</th>
                <td>{{ event.project }}</td>
                <td>{{ event.start.format('YYYY/MM/DD h:ss') }}</td>
                <td>{{ event.end.format('YYYY/MM/DD h:ss') }}</td>
                <td>{{ event.duration }}</td>
                <th scope="col">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Duplicate</a>
                            <a class="dropdown-item" href="#">Delete</a>
                        </div>
                    </div>
                </th>
                </tr>
            </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import EntryHttp from '../services/EntryHttp';
    import ProjectHttp from '../services/ProjectHttp';

    export default {
        props: {
        },

        data()
        {
            return {
                entries: [],
                projects: {},
                entryHttp: null,
                projectHttp: null,
            }
        },

        created()
        {
            this.entryHttp = new EntryHttp;
            this.projectHttp = new ProjectHttp;
            this.getProjects();
        },

        methods:
        {
            async getEntries() {
                try {
                    let response = await this.entryHttp.all();
                    this.entries = response.data.map(entry => {
                        return {
                            'title': entry.title,
                            'project_id': entry.project_id,
                            'project': entry.project_id in this.projects ? this.projects[entry.project_id].name : '',
                            'start': moment(entry.start),
                            'end': moment(entry.end),
                            'duration': moment.utc(
                                moment(entry.end).diff(moment(entry.start))
                            ).format('h:ss'),
                       };
                    });
                } catch (error) {
                    console.error(error);
                }
            },

            async getProjects() {
                try {
                    let response = await this.projectHttp.all();
                    this.projects = response.data;                   
                    this.getEntries();
                } catch (error) {
                    console.error(error);
                }
            },

        },

        mounted() {
        }
    }
</script>
