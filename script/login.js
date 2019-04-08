$(function() {
	new Vue({
		el: "#login-form",
		data: {
			jobid: '',
			password: ''
		},
		methods: {
			login: function(e) {
				var _this = $(e.target);

				this.toogle_btn(_this);

				if (this.jobid.length == 0) {
					this.toogle_btn(_this, false);
					alert_error_tip('请填写工号');
					return;
				}

				if (this.password.length == 0) {
					this.toogle_btn(_this, false);
					alert_error_tip('请填写密码');
					return;
				}

				send_data({
					url: 'api/users/login',
					data: {
						'id': this.jobid,
						'password': encrypt(this.password)
					},
					call: (data)=> {
						if (data['code'] == 200) {
							_this.text('登陆成功  (跳转中...)');
							alert_success_tip('登陆成功');
							setTimeout(() => {
								location.href = '/index.html';
							}, 3000);
						} else {
							this.toogle_btn(_this, false);
						}
					}
				})
			},
			toogle_btn: function(elem, flag = true) {
				if (flag) {
					elem.text('登录中...');
					elem.prop('disabled', true);
				} else {
					elem.text('登录');
					elem.prop('disabled', false);
				}
			}
		}
	});
})
