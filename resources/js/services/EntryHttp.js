class EntryHttp {
	constructor() {
		this.prefix = '/api/entry';
	}
	
	all () { return axios.get(this.prefix) }
	store (data) { return axios.post(this.prefix, data) }
	update (entry_id, data) { return axios.put(this.prefix + `/${entry_id}`, data) }
}

export default EntryHttp;