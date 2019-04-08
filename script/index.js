$(function() {

	new Vue({
		el: '#menu-list',
		data: {
			permis_list: ''
		},
		methods: {
			init: function() {
				this.getusinfo();
				
				$(this.$el).find('dt').click(this.menu_click);
				$(this.$el).find('a').click(this.menu_click);
			},
			getusinfo:function(){
				send_data({
					url: 'api/users/getinfo',
					call: (in_data) => {
						if (in_data['code'] == 200) {
							var data = in_data['data'];
							this.permis_list = data['permis-list'];
						} else if (in_data['code'] == 10003) {
							alert_error_tip(in_data['status']);
							location.href = '/login.html';
						} else alert_error_tip(in_data['status']);
					}
				});
			},
			menu_click:function(e){
				$(this.$el).find('dt').removeClass('menu-active');
				$(this.$el).find('a').removeClass('menu-active');

				$(e.target).addClass('menu-active');
			}
		}
	}).init();
})
