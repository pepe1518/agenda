function submitTopicsForm(a) {
	$("#search-topic").attr("value", "topic");
	$("#search-txtSearch").val($(a).attr("name"));
	$("#search-form").submit();
}

var baseDirectory;
var order;
var orderReady = true;

//TODO: Mejorar la forma de enviar los datos del order en el unload d ela pagina.
// $(window).unload(function () {
// sendOrderChanges();
// })

// window.onbeforeunload = function(){
// sendOrderChanges();
// //return 'holo?';
// };

$(document).ready(function() {
	baseDirectory = "/zf/public";
	//leave empty if it's in production
	retrieveOrderData();
	$(document).tooltip();
	$(".order-item-quantity").spinner({
		min : 1,
		change : orderItemQuantityChange
	});

	$("button, input[type=submit]").button();

	$('.announcements').cycle({
		fx : 'fade',
		timeout : 10000 // 10 seconds between animations
	});

	$("#dialog-message").dialog({
		modal : true,
		autoOpen : false,
		buttons : {
			Ok : function() {
				$(this).dialog("close");
			}
		}
	});
});

function addBookToCart(a) {
	var bookId = parseInt($(a).attr('book_id'));
	var priceBs = parseFloat($(a).attr('priceBs'));
	var priceSus = parseFloat($(a).attr('priceSus'));
	var newOrderItem = new OrderItem(bookId, priceBs, priceSus, 1);
	order.addOrderItem(newOrderItem);
	showPopupMessage("Éxito", "Se agrego 1 libro al carrito de compra.");
	sendOrderChanges();
}

function sendOrderChanges() {
	orderReady = false;
	$.ajax({
		url : baseDirectory + "/cart/ajaxsetcart",
		type : 'POST',
		async : false,
		data : {
			order : order.toString(),
		},
		success : function(data, textStatus, jqXHR) {
			order = new Order($.parseJSON(data));
			orderReady = true;
			updateCartSummaryInfo(order);
		},
		error : function(request, textStatus, errorThrown) {
			alert(textStatus);
		}
	});
}

function orderItemQuantityChange(e, ui) {
	//the name of this tag is the bookId
	var bookId = parseInt($(this).attr("bookId"));
	var quantity = parseInt($(this).spinner("value"));
	var orderItem = order.getOrderItemByBookId(bookId);
	orderItem.setQuantity(quantity);
	order.updateTotalCost();
	updateCartDetail(orderItem);

	sendOrderChanges();
}

function showPopupMessage(title, message) {
	$("#dialog-message").html(message)
	$("#dialog-message").attr("title", title);
	$("#dialog-message").dialog("open");
}

function retrieveOrderData() {
	orderReady = false;
	$.ajax({
		url : baseDirectory + "/cart/retrieve-order",
		type : "POST",
		success : function(data, textStatus, jqXHR) {
			order = new Order($.parseJSON(data));
			orderReady = true;
			updateCartSummaryInfo(order);
		}
	})
}

function removeOrderItem(bookId) {
	order.removeOrderItem(bookId);
	$("#orderItemRow_" + bookId).fadeOut(300, function() {
		$(this).remove();
	});
	updateTotalsCartDetail();
	sendOrderChanges();
}

function updateCartDetail(orderItem) {
	$('#totalBs_' + orderItem.getBookId()).html(orderItem.getTotalCostBs().toFixed(2));
	$('#totalSus_' + orderItem.getBookId()).html(orderItem.getTotalCostSus().toFixed(2));
	updateTotalsCartDetail();
}

function updateTotalsCartDetail() {
	$('#orderTotalCostBs').html(order.getTotalCostBs().toFixed(2));
	$('#orderTotalCostSus').html(order.getTotalCostSus().toFixed(2));
}

function updateCartSummaryInfo() {
	$('#cart_total_quantity').html(order.getTotalItems());
	$('#cart_summary_total_cost_sus').html(order.getTotalCostSus().toFixed(2));
	$('#cart_summary_total_cost_bs').html(order.getTotalCostBs().toFixed(2));

	if (order.getTotalItems() > 0) {
		$('#cart_summary_logo').removeClass('cart_empty').addClass('cart_full');
	} else {
		$('#cart_summary_logo').removeClass('cart_full').addClass('cart_empty');
	}
}

function changeOrderType(radioButton) {
	var orderType = $(radioButton).attr("value");
	order.setOrderType(orderType);
	sendOrderChanges();
}

function Order(orderJSON) {
	var _orderItems = new Array();
	var _totalCostSus = 0.00;
	var _totalCostBs = 0.00;
	var _orderType = "buy";

	var parseOrderJSON = function() {
		_orderType = orderJSON.orderType;
		_totalCostBs = orderJSON.totalCostBs;
		_totalCostSus = orderJSON.totalCostSus;

		var i = 0;
		for ( i = 0; i < orderJSON.orderItems.length; i++) {
			_orderItems.push(new OrderItem(orderJSON.orderItems[i].bookId, orderJSON.orderItems[i].priceBs, orderJSON.orderItems[i].priceSus, orderJSON.orderItems[i].quantity));
		}
	}
	parseOrderJSON();

	this.addOrderItem = function(newOrderItem) {
		var isNew = true;
		for (var i = 0; i < _orderItems.length; i++) {
			if (_orderItems[i].getBookId() == newOrderItem.getBookId()) {
				isNew = false;
				_orderItems[i].setQuantity(_orderItems[i].getQuantity() + newOrderItem.getQuantity());
				break;
			}
		}
		if (isNew == true) {
			_orderItems.push(newOrderItem);
		}
		this.updateTotalCost();
	};

	this.getOrderItemByBookId = function(bookId) {
		for (var i = 0; i < _orderItems.length; i++) {
			if (_orderItems[i].getBookId() == bookId) {
				break;
			}
		}
		return _orderItems[i];
	}

	this.removeOrderItem = function(bookId) {
		for (var i = 0; i < _orderItems.length; i++) {
			if (_orderItems[i].getBookId() == bookId) {
				break;
			}
		}
		_orderItems.splice(i, 1);
		this.updateTotalCost();
	}

	this.getTotalItems = function() {
		return _orderItems.length;
	}

	this.getOrderType = function() {
		return _orderType;
	}

	this.setOrderType = function(orderType) {
		_orderType = orderType;
	}

	this.getTotalCostBs = function() {
		return _totalCostBs;
	}

	this.getTotalCostSus = function() {
		return _totalCostSus;
	}
	this.updateTotalCost = function() {
		_totalCostBs = 0.00;
		_totalCostSus = 0.00;
		for (var i = 0; i < _orderItems.length; i++) {
			_totalCostBs = _totalCostBs + _orderItems[i].getTotalCostBs();
			_totalCostSus = _totalCostSus + _orderItems[i].getTotalCostSus();
		}
	}

	this.toString = function() {
		var result = "";

		result += "{";
		result += "\"orderType\" : \"" + _orderType + "\",";
		result += "\"totalCostSus\" : " + _totalCostSus + ",";
		result += "\"totalCostBs\" : " + _totalCostBs + ",";
		result += "\"orderItems\" : [";
		var i = 0;
		for ( i = 0; i < _orderItems.length; i++) {
			result += "{";
			result += "\"bookId\" : " + _orderItems[i].getBookId() + ",";
			result += "\"priceSus\" : " + _orderItems[i].getPriceSus() + ",";
			result += "\"priceBs\" : " + _orderItems[i].getPriceBs() + ",";
			result += "\"totalCostSus\" : " + _orderItems[i].getTotalCostSus() + ",";
			result += "\"totalCostBs\" : " + _orderItems[i].getTotalCostBs() + ",";
			result += "\"quantity\" : " + _orderItems[i].getQuantity() + "";
			if (i < _orderItems.length - 1) {
				result += "},";
			} else {
				result += "}";
			}
		}
		result += "]";
		result += "}";
		return result;
	}
}

function OrderItem(bookId, priceBs, priceSus, quantity) {
	var _bookId = bookId;
	var _priceBs = priceBs;
	var _priceSus = priceSus;
	var _quantity = 1;
	var _totalCostBs = priceBs;
	var _totalCostSus = priceSus;

	this.getBookId = function() {
		return _bookId;
	}

	this.setQuantity = function(quantity) {
		_quantity = quantity;
		updateTotalCost();
	}

	this.getQuantity = function() {
		return _quantity;
	}

	this.getTotalCostBs = function() {
		return _totalCostBs;
	}

	this.getTotalCostSus = function() {
		return _totalCostSus;
	}

	this.getPriceBs = function() {
		return _priceBs;
	}

	this.getPriceSus = function() {
		return _priceSus;
	}
	var updateTotalCost = function() {
		_totalCostBs = _quantity * _priceBs;
		_totalCostSus = _quantity * _priceSus;
	}
	if (quantity != undefined && quantity != null) {
		_quantity = quantity;
		updateTotalCost();
	}
}
