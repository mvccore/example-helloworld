Class.Define('Front',{
	Extend: Module,
	Static: {
		CLICKABLE_LINKS_SELECTOR: 'a.clickable-link',
		CLICKABLE_CONTENTS_SELECTOR: 'div.clickable-content',
		SESSION_STORAGE_KEY: 'mvccore-hello-world-%i'
	},
	Constructor: function () {
		this.parent();
		this.PrintHalloWorld();
		this.initializeClickableSections();
	},
	// hello world:
	PrintHalloWorld: function () {
		console.log(document.getElementsByTagName("h1")[0].innerHTML);
	},
	ThrownTestError: function () {
		// run in console `front.ThrownTestError();` to send error to server log from javascript
		setTimeout(function () {
			throw new Error("Front class error :-)");
		});
	},
	// clickable sections:
	linkElms: [],
	contentElms: [],
	initializeClickableSections: function () {
		this.linkElms = document.querySelectorAll(this.self.CLICKABLE_LINKS_SELECTOR);
		this.contentElms = document.querySelectorAll(this.self.CLICKABLE_CONTENTS_SELECTOR);
		for (var i = 0, l = this.linkElms.length; i < l; i += 1)
			this.initializeClickableSection(i);
	},
	initializeClickableSection: function (i) {
		var linkIsOpened = this.clickableLinkOpenedBySession(i, false);
		if (linkIsOpened) {
			this.clickableLinkOpenedBySession(i, true);
			this.clickableSectionHandler(i);
		}
		this.linkElms[i].onclick = this.clickableSectionHandler.bind(this, i);
	},
	clickableSectionHandler: function (i, e) {
		var linkIsOpened = this.clickableLinkOpenedBySession(i, false),
			linkElm = this.linkElms[i],
			contentElm = this.contentElms[i];
		if (linkIsOpened) {
			contentElm.className = contentElm.className + ' hidden';
			linkElm.className = linkElm.className.replace(' opened', '');
		} else {
			contentElm.className = contentElm.className.replace(' hidden', '');
			linkElm.className = linkElm.className + ' opened';
		}
		this.clickableLinkOpenedBySession(i, true);
		linkElm.blur();
		this.reRenderBackgroundImageFix();
	},
	clickableLinkOpenedBySession: function (i, toggle) {
		var sessionStorrageKey = this.self.SESSION_STORAGE_KEY.replace('%i', i),
			sessionRawValue = sessionStorage[sessionStorrageKey],
			result = parseInt(typeof (sessionRawValue) == 'undefined' ? '0' : sessionRawValue, 10);
		if (toggle)
			sessionStorage[sessionStorrageKey] = result ? 0 : 1;
		return result;
	},
	reRenderBackgroundImageFix: function () {
		var htmlElmStyle = document.body.parentNode.style;
		htmlElmStyle.backgroundAttachment = 'fixed';
		htmlElmStyle['background-attachment'] = 'fixed';
		setTimeout(function () {
			htmlElmStyle.backgroundAttachment = 'scroll';
			htmlElmStyle['background-attachment'] = 'scroll';
		});
	}
});

if (!console) {
	var console = {
		log: function () { }
	}
}

// run all declared javascripts after <body>, after all elements are declared
window.front = new Front();
