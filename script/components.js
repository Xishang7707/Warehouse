Vue.component('login-input', {
	props: {
		placeholder: '',
		val: '',
		id: '',
		type: 'text'
	},
	methods: {
		in_focus: function(e) {
			_this = $(e.target);
			_label = _this.prev();
			_this.animate({
				'border-bottom': '2rem solid #09f'
			}, 200);
			_label.animate({
				'font-size': '0.7rem',
				'padding-top': '0rem'
			}, 200);
		},
		in_blur: function(e) {
			if (_this.val() != '')
				return;
			_this = $(e.target);
			_label = _this.prev();
			_this.animate({
				'border-bottom': '2rem solid #fff'
			}, 200);
			_label.animate({
				'font-size': '1.2rem',
				'padding-top': '1rem'
			}, 200);
		},
		updateVal: function(e) {
			this.$emit('change-val', e.target.value);
		}
	},
	template: '<div style="width:100%"><label class="text-white pl-2" :for=id style="position: absolute; font-size: 1.2rem; padding-top:1rem;">{{placeholder}}</label><input :id=id :type=type @focusin="in_focus" @focusout="in_blur" class="text-white pl-2 pt-3" style="display:block; font-size:1.2rem; width:100%;border:none; border-bottom:2px solid #fff; background: #0000;" @input=updateVal :value=val maxlength="20"/></div>'
})


Vue.component('menu-list-item', {
	props: {
		url: {
			default: 'http://baidu.com'
		},
		target: {
			default: '#menu-content'
		}
	},
	methods: {
		click: function(e) {
			$(this.target).prop('src', this.url);
		}
	},
	template: '<li><a class="p-2 pl-4" style="display: block;" @click=click><slot></slot></a></li>'
})

Vue.component('menu-list', {
	props: {
		id:'',
		p_id:'',
		menu_list_item: '',
		target: '#menu-content'
	},
	template: '<dl>' +
		'<dt class="text-white" data-toggle="collapse" :data-target="\'#menu-list-item-\'+id">' +
		'<a class="font-weight-bold p-2" style="display:block;"><slot></slot></a>' +
		'</dt>' +
		'<dd :id="\'menu-list-item-\'+id" class="collapse" data-parent="#menu-list">' +
		'<ul class="text-white">' +
		'<menu-list-item v-for="item in menu_list_item" :url="item.url" :target=target>{{item.name}}</menu-list-item>' +
		'</ul>' +
		'</dd>' +
		'</dl>'
})
