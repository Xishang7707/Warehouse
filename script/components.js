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
