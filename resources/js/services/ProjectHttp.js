class EntryHttp {
	constructor() {
		this.prefix = '/api/project';
	}
	
	all () { return axios.get(this.prefix) }
}

export default ProjectHttp;