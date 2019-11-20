let statics = {
    fields: []//屏蔽列的数组
};

let methods = {
    //时间不足10加0显示
    add0:function (value) {
        return value < 10 ? "0"+value : value;
    },
    //获取当期时间
    getNowDate:function () {
        let date = new Date(),
            Y  = date.getFullYear(),//年
            M  = date.getMonth()+1,//月
            D  = date.getDate(),//日
            H  = date.getHours(),
            Mi = date.getMinutes(),
            S  = date.getSeconds();
        return `${Y}-${this.add0(M)}-${this.add0(D)}-${this.add0(H)}-${this.add0(Mi)}-${this.add0(S)}`;
    },
    //过滤数组中包含某个数组;
    filterArr:function (arr,filterArr){
        return arr.filter(item => filterArr.indexOf(item) == -1);
    },
    //生成有序数组[0,1,2,3,4,5]
    orderlyNum:function (beginNum,endNum) {
        let arr=[];for(let i=beginNum;i<=endNum;i++)arr[i-beginNum]=i;
        return arr;
    },
    //屏蔽列
    shieldColor:function (shield,obj,_shieldType,btnNum){
            let type = 1;
            $(obj).toggleClass('layui-btn-normal').toggleClass('layui-btn-primary');
            let flag = $(obj).hasClass('layui-btn-normal');
            let _shieldArr = [];//删选的数组
            let _effectsArray = ['cost','zhanshi','dianji','click_rate','jihuo','activation_rate','activation_conversion','StarDownloadFirstZIP','DownDoneFirstZIP','activation_cost','activere','activere_rate','huiliu', 'hotstart','hotend','hot_rate','sdkjihuo','sdkjihuo_rate','sdkjihuo_rate','sdkjihuo_rate','zhuche','register_rate','register_conversion','register_cost','createrole','createrole_rate','quxin',':2','keep_rate','keep_cost',':3','3keep_rate',':7','7keep_rate',':15','15keep_rate','15keep_cost',':30','30keep_rate','30keep_cost','qineipaynum','qineipaynum_rate','qineipayamount','qineipayamount_cost','qinei_ARPU','zhijinpaynum','zhijinpaynum_rate','zhijinpayamount','zhijinpayamount_cost','zhijin_ARPU','paynum','payamount','total_pay_rate','total_ARPU'];
            let _dateArray = methods.orderlyNum(0,23);
            let _array = _shieldType === "2" ? _effectsArray : _dateArray;
            if(flag){
                $("[data-field='title"+shield+"']").hide();
            }else{
                $("[data-field='title"+shield+"']").show();
            }
            switch(shield) {
                case 1:
                     _shieldArr = ['cost','zhanshi','dianji','click_rate','jihuo','activation_rate','activation_conversion','activation_cost','huiliu'];
                    if(flag){
                        if(_shieldType==="2"){
                            statics.fields=statics.fields.concat(_shieldArr);
                        }else{
                            statics.fields=statics.fields.concat(this.orderlyNum(0,5));
                        }
                    }else{
                        if(_shieldType==="2"){
                            statics.fields = this.filterArr(statics.fields,_shieldArr);
                        }else{
                            statics.fields = this.filterArr(statics.fields,this.orderlyNum(0,5))
                        }
                    }
                    type = 0;
                    break;
                case 2:
                    _shieldArr = ['StarDownloadFirstZIP','DownDoneFirstZIP','hotstart','hotend','hot_rate','sdkjihuo','sdkjihuo_rate','sdkjihuo_rate','sdkjihuo_rate','zhuche','register_rate','register_conversion','register_cost','createrole','createrole_rate','quxin','activere','activere_rate'];
                    if(flag){
                        if(_shieldType==="2"){
                            statics.fields=statics.fields.concat(_shieldArr);
                        }else{
                            statics.fields=statics.fields.concat(this.orderlyNum(6,11));
                        }
                    }else{
                        if(_shieldType==="2"){
                            statics.fields = this.filterArr(statics.fields,_shieldArr);
                        }else{
                            statics.fields = this.filterArr(statics.fields,this.orderlyNum(6,11))
                        }
                    }
                    type = 0;
                    break;
                case 3:
                    _shieldArr = [':2','keep_rate','keep_cost',':3','3keep_rate',':7','7keep_rate'];
                    if(flag){
                        if(_shieldType==="2"){
                            statics.fields=statics.fields.concat(_shieldArr);
                        }else{
                            statics.fields=statics.fields.concat(this.orderlyNum(12,17));
                        }
                    }else{
                        if(_shieldType==="2"){
                            statics.fields = this.filterArr(statics.fields,_shieldArr);
                        }else{
                            statics.fields = this.filterArr(statics.fields,this.orderlyNum(12,17))
                        }
                    }
                    type = 0;
                    break;
                case 4:
                    _shieldArr = btnNum?['qineipaynum','qineipaynum_rate','qineipayamount','qineipayamount_cost','qinei_ARPU','zhijinpaynum','zhijinpaynum_rate','zhijinpayamount','zhijinpayamount_cost','zhijin_ARPU','paynum','payamount','total_pay_rate','total_ARPU']:[':15','15keep_rate','15keep_cost',':30','30keep_rate','30keep_cost'];
                    if(flag){
                        if(_shieldType==="2"){
                            statics.fields=statics.fields.concat(_shieldArr);
                        }else{
                            statics.fields=statics.fields.concat(this.orderlyNum(18,23));
                        }
                    }else{
                        if(_shieldType==="2"){
                            statics.fields = this.filterArr(statics.fields,_shieldArr);
                        }else{
                            statics.fields = this.filterArr(statics.fields,this.orderlyNum(18,23))
                        }
                    }
                    type = 0;
                    break;
                case 5:
                    _shieldArr = ['qineipaynum','qineipaynum_rate','qineipayamount','qineipayamount_cost','qinei_ARPU','zhijinpaynum','zhijinpaynum_rate','zhijinpayamount','zhijinpayamount_cost','zhijin_ARPU','paynum','payamount','total_pay_rate','total_ARPU'];
                    if(flag){
                        if(_shieldType==="2"){
                            statics.fields=statics.fields.concat(_shieldArr);
                        }
                    }else{
                        if(_shieldType==="2"){
                            statics.fields = this.filterArr(statics.fields,_shieldArr);
                        }
                    }
                    type = 0;
                    break;
            }

            this.hideShowTableTd('dataTable', _array, 1);
            if (shield != 0) {
                this.hideShowTableTd('dataTable', statics.fields, type);
            }
    },
    /**
      * table列显示隐藏
      * @param tableId
      * @param fields table列field 例：['id', 'name']
      * @param type 显示隐藏列 0.隐藏table列 1.显示table列
      */
    hideShowTableTd:function (tableId, fields, type = 0) {
        var tables = $('#' + tableId).next().find(".layui-table-box");
        for (let i = 0; i < fields.length; i++) {
            if (type) {
                tables.find("[data-field='" + fields[i] + "']").show();
            } else {
                tables.find("[data-field='" + fields[i] + "']").hide();
            }
        }
    },
    //数组删除含有的某个值；
    removeIncludeVal:function(arr, val) {
        for(var i=0; i<arr.length; i++) {
            if(arr[i] == val) {
                arr.splice(i, 1);
            }
        }
    },
    replaceFont:function (font){
    let showName = '';
        switch(font) {
            case 'show_sum':
                showName = '展示数';
                break;
            case 'click_sum':
                showName = '点击数';
                break;
            case 'click_ratio':
                showName = '点击率';
                break;
            case 'create_role_ratio':
                showName = '创角率';
                break;
            case 'create_role_sum':
                showName = '创角数';
                break;
            case 'jihuo_ratio':
                showName = '激活率';
                break;
            case 'jihuo_sum':
                showName = '激活数';
                break;
            case 'next_day_ratio':
                showName = '次日留存率';
                break;
            case 'register_ratio':
                showName = '注册率';
                break;
            case 'register_sum':
                showName = '注册数';
                break;
            case 'sdk_jihuo_ratio':
                showName = 'SDK激活率';
                break;
            case 'sdk_jihuo_sum':
                showName = 'SDK激活数';
                break;
            case 'seven_day_ratio':
                showName = '七日留存率';
                break;
        }
            return showName;
    }
};

//调用方法
//屏蔽列调用
$(document).on('click','.shield-container button',function () {
// $('.shield-container button').click(function () {
    let _btnIndex = $(this).index(),
        _shieldType = $(this).parents('.shield-container').attr('data-type'), //屏蔽类型，2：广告 效果详情； 默认是监控时表；
        _btnNum = $(this).attr('data-index'); //最后一个按钮数量
        methods.shieldColor(_btnIndex+1,this,_shieldType,_btnNum);
});
//回车搜索
$(document).keydown(function (e) { // 回车提交表单
    let theEvent = window.event || e,
        code = theEvent.keyCode || theEvent.which,
        btnLength = $("#btn-sublimt").length;
    if (code === 13 && btnLength) {
        $("#btn-sublimt").click();
    }
});