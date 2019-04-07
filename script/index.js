var permis_config = {
	'101': '入库管理',
	'102': '出库管理',
	'103': '借货',
	'104': '还货',
	'105': '盘点管理',
	'201': '供货商设置',
	'202': '货物档案设置',
	'203': '仓库设置',
	'301': '库存查询',
	'302': '出入库查询',
	'303': '借还货物查询',
	'304': '警戒货物',
	'305': '出入货物月统计',
	'306': '出入货物年统计',
	'401': '用户列表',
	'402': '修改密码',
	'403': '重新登录',
	'404': '退出登录',
	'501': '数据验证',
	'502': '数据还原',
	'503': '数据压缩',
	'601': '产品出入库管理',
	'602': '事件记录',
	'603': '报表生成',
	'701': '使用说明',
	'702': '关于本系统'
};

$(function() {

	new Vue({
		el: '#menu-list',
		data: {
			permis_list: ''
		},
		methods: {
			init: function() {
				send_data({
					url: 'api/users/getinfo',
					call: (in_data) => {
						if (in_data['code'] == 200) {
							var data = in_data['data'];
							this.permis_list = data['permis-list'];
						} else if (in_data['code'] == 10003)
							location.href = '/login.html';
						else alert_error_tip(in_data['status']);
					}
				})
			}
		}
	}).init();
})
