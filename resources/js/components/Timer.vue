<template>
    <div class="container">
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
                <tr v-for="event in timeEvents">
                <th scope="row">{{ event.title }}</th>
                <td>{{ event.project }}</td>
                <td>{{ event.start.format('YYYY MM DD h:ss') }}</td>
                <td>{{ event.end.format('YYYY MM DD h:ss') }}</td>
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
    export default {
        props: {
            // attrTimeEvents: {
            //     type: Array,
            //     default: () => {[]}, 
            // },
        },

        data()
        {
            return {
                timeEvents: [],
            }
        },

        mounted() {
            this.timeEvents = [
                {
                    'title': 'Coding in Laravel',
                    'project': 'Awesomesauce',
                    'start': moment([2010, 1, 14, 15, 25, 50, 125]), // 2010 February 14th, 3:25:50.125 PM
                    'end': moment([2010, 1, 14, 16, 35, 50, 125]), // 2010 February 14th, 4:35:50.125 PM
                    'duration': '01:14',
                }, 
                {
                    'title': 'Coding in JavaScript',
                    'project': 'Project2',
                    'start': moment([2010, 2, 14, 15, 25, 50, 125]), // 2010 February 14th, 3:25:50.125 PM
                    'end': moment([2010, 2, 14, 16, 35, 50, 125]), // 2010 February 14th, 4:35:50.125 PM
                    'duration': '01:14',
                }, 
            ]
            //  JSON.parse(attrTimeEvents);
        }
    }
</script>
