Class.Define('Front',{
	Extend: Module,
	Constructor: function () {
		this.parent();
		console.log(document.getElementsByTagName("h1")[0].innerHTML);
		//throw new Error("test error");
	}
});

// run all declared javascripts after <body>, after all elements are declared
window.front = new Front();