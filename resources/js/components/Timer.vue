<template>
    <div class="container">
        <form>
            <div class="form-row align-items-center">
                <div class="col-4">
                    <label class="sr-only" for="entryTitle">Title</label>
                    <input type="text" v-model="entryTitle" class="form-control" id="entryTitle" placeholder="What are you working on?">
                </div>
                <div class="col-3">
                    <label class="sr-only" for="entryProject">Project</label>
                    <select v-model="entryProject" class="custom-select my-1 mr-sm-2" id="entryProject">
                       <option v-for="project in projects" :value="project.id" >{{ project.name }}</option>
                    </select>
                </div>
                <div class="col-2">
                    <label class="sr-only" for="entryDuration">Title</label>
                    <input type="time" v-model="entryDuration" class="form-control" id="entryDuration" disabled></input>
                </div>
                <div class="col-1">
                    <button @click.stop.prevent="togglePlay" class="btn btn-primary" :class="playing ? 'bg-danger' : 'bg-success'">{{ playing ? 'Stop' : 'Start' }}</button>
                </div>
            </div>
    </form>
    </div>
</template>

<script>
    import EntryHttp from '../services/EntryHttp';

    export default {
        props: {
            projects: {
                type: Object,
                default: () => ({})
            }
        },

        data()
        {
            return {
                playing: false,
                entryTitle: '',
                entryProject: null,
                entryDuration: "00:00",
                entryStart: null,
                entryEnd: null,
                entryId: null,
                entryHttp: null,
            }
        },

        created() {
            this.entryHttp = new EntryHttp;
        },

        mounted() {
        },

        methods:
        {
            togglePlay() {
                this.playing = !this.playing;

                if (this.playing) {
                    this.countTimer();
                    this.entryStart = moment();
                    this.createTimeEntry();
                } else {
                    this.endTimeEntry();
                    // TODO: add to list of entries on page
                }
            },

            async createTimeEntry() {
                let data = {
                    'title': this.entryTitle,
                    'project_id': this.entryProject,
                    'start': this.entryStart.format('YYYY-MM-DD HH:mm:ss'),
                };

                try {
                    let response = await this.entryHttp.store(data);
                    console.log("Stored time entry");
                } catch (error) {
                    console.error(error);
                }
            },

            async endTimeEntry() {
                this.entryEnd = new Date();
                this.saveTimeEntry();
            },

            async saveTimeEntry() {
                let data = {
                    'title': this.entryTitle,
                    'project_id': this.entryProject,
                    'start': this.entryStart,
                    'end': this.entryStart,
                };

                // TODO: save
            },

            async countTimer() {
                if (this.playing) {
                    this.entryDuration = this.entryDuration.substring(0,4) + (Number(this.entryDuration.substring(4)) + 1);
                    window.setTimeout(this.countTimer, 1000);
                }
            }


        }

    }
</script>
