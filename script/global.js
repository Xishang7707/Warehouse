var pubkey =
	"-----BEGIN PUBLIC KEY-----MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCm0fuTsiRU9STm7RyjHJVxJiWrJtd1mI3rFDKMf4NwjljswwsE+XZQgQefhFsmIsk96vnUTb4nIwXeesuGHr4k62qLfSc7HxhKDnWY7NkBv/7MIXhFAgVu1sPDADyJJY7y+R7X4g5fbxnzS42UEsTOuvAHE0RQtUpT7kr14w+oFwIDAQAB-----END PUBLIC KEY-----";

function encrypt(data) {
	var encrypt = new JSEncrypt();
	encrypt.setPublicKey(pubkey);
	var encrypted = encrypt.encrypt(data);
	return encrypted;
}

function send_data({
	url,
	data,
	call
}) {
	$.ajax({
		url: url,
		type: 'POST',
		data: data,
		success: function(data) {
			if (call) {
				call(data);
			}
		}
	})
}

Date.prototype.format = function (fmt) {
    var o = {
        "M+": this.getMonth() + 1, //月份 
        "d+": this.getDate(), //日 
        "h+": this.getHours(), //小时 
        "m+": this.getMinutes(), //分 
        "s+": this.getSeconds(), //秒 
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度 
        "S": this.getMilliseconds() //毫秒 
    };
    if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
        if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
}

function getQuery(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        if (pair[0] == variable) { return pair[1]; }
    }
    return (false);
}

function alert_info_tip(info, sec = 3000, click) {
	var elem = $(
		'<div class="container-fluid fixed-top" style="z-index:5000;margin-top:56px;"><div class="row p-0 d-flex flex-wrap justify-content-center"><div class="col-md-6 p-2"><div class="alert tip alert-info alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>信息：</strong>' +
		info + '</div></div></div></div>');
	$(document.body).prepend(elem);
	elem.find(".info").click(click);
	setTimeout(() => {
		$(".alert.tip").alert('close');
		elem.remove();
	}, sec)
}

function alert_error_tip(info, sec = 3000) {
	var elem = $(
		'<div class="container-fluid fixed-top" style="z-index:5000;margin-top:56px;"><div class="row p-0 d-flex flex-wrap justify-content-center"><div class="col-md-6 p-2"><div class="alert tip alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>错误：</strong>' +
		info + '</div></div></div></div>');
	$(document.body).prepend(elem);
	//elem.find(".info").click(click);
	setTimeout(() => {
		$(".alert.tip").alert('close');
		elem.remove();
	}, sec)
}

function alert_success_tip(info, sec = 3000) {
	var elem = $(
		'<div class="container-fluid fixed-top" style="z-index:5000;margin-top:56px;"><div class="row p-0 d-flex flex-wrap justify-content-center"><div class="col-md-6 p-2"><div class="alert tip alert-success alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>成功：</strong>' +
		info + '</div></div></div></div>');
	$(document.body).prepend(elem);
	//elem.find(".info").click(click);
	setTimeout(() => {
		$(".alert.tip").alert('close');
		elem.remove();
	}, sec)
}