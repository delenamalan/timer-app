class EntryHttp {
	constructor() {
		this.prefix = '/api/entry';
	}
	
	all () { return axios.get(this.prefix) }
	store (data) { return axios.post(this.prefix, data) }
}

export default EntryHttp;