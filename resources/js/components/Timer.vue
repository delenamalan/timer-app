<template>
    <div class="container">
        <div class="card p-2 my-2">
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
                        <input type="text" v-model="entryDuration" class="form-control" id="entryDuration" disabled></input>
                    </div>
                    <div class="col-1">
                        <button :disabled="!(entryTitle && entryProject)" @click.stop.prevent="togglePlay" class="btn btn-primary" :class="playing ? 'bg-danger' : 'bg-success'">{{ playing ? 'Stop' : 'Start' }}</button>
                    </div>
                </div>
            </form>
        </div>
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
                hours: 0,
                minutes: 0,
                seconds: 0,
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
                    this.entryId = response.data.id;
                    console.log("Stored time entry");
                } catch (error) {
                    console.error(error);
                }
            },

            async endTimeEntry() {
                this.entryEnd = moment();
                this.saveTimeEntry();
            },

            async saveTimeEntry() {
                let data = {
                    'title': this.entryTitle,
                    'project_id': this.entryProject,
                    'start': this.entryStart.format('YYYY-MM-DD HH:mm:ss'),
                    'end': this.entryEnd.format('YYYY-MM-DD HH:mm:ss'),
                };

                try {
                    let response = await this.entryHttp.update(this.entryId, data);
                    this.$emit('end-entry', data);
                    console.log("Stored time entry");
                } catch (error) {
                    console.error(error);
                }
            },

            async countTimer() {
                if (this.playing) {
                    this.seconds += 1;
                    if (this.seconds == 60) {
                        this.minutes += 1;
                        this.seconds = 0;
                    }
                    if (this.minutes == 60) {
                        this.hours += 1;
                        this.minutes = 0;
                    }

                    this.entryDuration = `${this.pad(this.hours, 2)}:${this.pad(this.minutes, 2)}:${this.pad(this.seconds, 2)}`;
                    window.setTimeout(this.countTimer, 10);
                }
            },

            pad(n, width, z) {
                z = z || '0';
                n = n + '';
                return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
            },
        }
    }
</script>
