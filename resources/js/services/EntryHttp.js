class EntryHttp {
	constructor() {
		this.prefix = '/api/entry';
	}
	
	all () { return axios.get(this.prefix) }
}

export default EntryHttp;