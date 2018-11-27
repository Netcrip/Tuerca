
$(function () {
    "use strict";
    var line = new Morris.Line({
      element: 'line-chart',
      resize: true,
      data: [
        {y: '2007', item1: 0},
        {y: '2008', item1: 15600},
        {y: '2009', item1: 25000},
        {y: '2010', item1: 49000},
        {y: '2011', item1: 66000},
        {y: '2012', item1: 81000},
        {y: '2013', item1: 96000},
        {y: '2014', item1: 10000},
        {y: '2015', item1: 115000},
        {y: '2016', item1: 120000}
      ],
		xkey: 'y',
		ykeys: ['item1'],
		labels: ['Analatics'],
		lineWidth:2,
		pointFillColors: ['rgba(30,136,229,1)'],
		lineColors: ['rgba(30,136,229,1)'],
		hideHover: 'auto',
    });
  });