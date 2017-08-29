/*@author hejian 2017年8月24日*/
$.fn.extend({
	table_scroll: function(options) {
		var _options = {
			beginRow: 0,
			rowInScrollableArea: 5
		};
		if (options) {
			if (options.beginRow) {
				_options.beginRow = options.beginRow
			}
			if (options.rowInScrollableArea) {
				_options.rowInScrollableArea = options.rowInScrollableArea
			}
			if (_options.beginRow >= _options.rowInScrollableArea) {
				console.log("固定宽度不能大于可视宽度");
				return false
			}
		}
		var _this = $(this);
		var _tbodyTr = $(this).children("tbody").find("tr");
		var _trLen = _tbodyTr.length;
		var trHeightArray = [];
		var _showRowHeig = 0;
		var hei = 0;
		_tbodyTr.each(function() {
			if ($(this).index() < _options.rowInScrollableArea) {
				_showRowHeig += $(this).height()
			} else {
				hei += $(this).height();
				trHeightArray.push(hei)
			}
		});
		var _scollHeigh = _this.children("tbody").height() - _showRowHeig + 1;
		_this.find("tr").find("th:last").attr("colspan", 2);
		_this.find("tr").find("td:last").attr("colspan", 2);
		var _colLeng = _this.find("thead").find("th").length;
		var _rowHeight = _this.children("tbody").height() - 1 - 2 * _trLen;
		_tbodyTr.each(function() {
			var index = $(this).index();
			if (index >= (_options.rowInScrollableArea)) {
				$(this).hide()
			}
		});
		if (_trLen <= _options.rowInScrollableArea) {
			return false
		} else {
			var str = '<tr style="height: 1px ;width: 1px"><td  colspan="' + (_colLeng) + '" style="padding: 0;height: 0"></td><td  style="padding: 0;border-width: px;border-left-width: 0;" rowspan=' + (_options.rowInScrollableArea - _options.beginRow + 1) + ' class="croll-cell"><div class="scroll-container" style="overflow-y:scroll;float: right ;display: block; height: ' + _showRowHeig + 'px;"><div style="width: 1px; height: ' + _rowHeight + 'px;"></div></div></td></tr>'
		}
		_tbodyTr.eq(_options.beginRow).before(str);
		_this.find(".scroll-container").on("scroll", function() {
			var len = ($(this).scrollTop() / _scollHeigh) * hei;
			var _index = 0;
			$.each(trHeightArray, function(k, v) {
				if (len >= v) {
					if (v <= len) {
						_index = k + _options.rowInScrollableArea + 1
					}
				} else {
					if (len == 0) {
						_index = _options.rowInScrollableArea
					} else {
						_index = k + _options.rowInScrollableArea + 1;
						return false
					}
				}
			});
			_this.find("tr").each(function() {
				if ($(this).index() > _options.beginRow) {
					$(this).css("display", "none")
				}
			});
			_this.find("tr").each(function() {
				var index = $(this).index();
				if (index > (_index - _options.rowInScrollableArea + _options.beginRow) && index <= _index) {
					$(this).css("display", "")
				}
			})
		})
	}
});