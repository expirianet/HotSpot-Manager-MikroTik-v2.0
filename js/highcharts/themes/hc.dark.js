/**
 * MIKHMON Dark theme for Highcharts JS
 * @author Laksamadi Guko
 */

Highcharts.theme = {
	colors: ["#70f86b", "#fc4847"],
	chart: {
		backgroundColor: 'rgba(255,255,255,0.2)',
		borderColor: 'none',
		borderWidth: 1,
		className: 'dark-chart',
		plotBackgroundColor: 'none',
		plotBorderColor: 'none',
		plotBorderWidth: 1,
		height: '300px'
	},
	title: {
		style: {
			color: '#f3f4f5',
			font: 'bold 14px "Trebuchet MS", Verdana, sans-serif, Roboto,"Seggoe UI"'
		}
	},
	subtitle: {
		style: {
			color: '#f3f4f5',
			font: 'bold 12px "Trebuchet MS", Verdana, sans-serif'
		}
	},
	xAxis: {
		gridLineColor: '#f3f4f5',
		gridLineWidth: 1,
		labels: {
			style: {
				color: '#f3f4f5'
			}
		},
		lineColor: '#f3f4f5',
		tickColor: '#f3f4f5',
		title: {
			style: {
				color: '#f3f4f5',
				fontWeight: 'bold',
				fontSize: '12px',
				fontFamily: 'bold 16px "Trebuchet MS", Verdana, sans-serif, Roboto,"Seggoe UI"'

			}
		}
	},
	yAxis: {
		gridLineColor: '#f3f4f5',
		labels: {
			style: {
				color: '#f3f4f5'
			}
		},
		lineColor: '#f3f4f5',
		minorTickInterval: null,
		tickColor: '#f3f4f5',
		tickWidth: 1,
		title: {
			style: {
				color: '#f3f4f5',
				fontWeight: 'bold',
				fontSize: '12px',
				fontFamily: 'bold 16px "Trebuchet MS", Verdana, sans-serif, Roboto,"Seggoe UI"'
			}
		}
	},
	plotOptions: {
		series: {
			fillOpacity: 0.1
		}
	},
	tooltip: {
		backgroundColor: 'rgba(58, 65, 73, 0.75)',
		style: {
			color: '#f3f4f5'
		}
	},
	legend: {
		itemStyle: {
			font: '9pt Trebuchet MS, Verdana, sans-serif',
			color: '#f3f4f5'
		},
		itemHoverStyle: {
			color: '#20a8d8'
		},
		itemHiddenStyle: {
			color: '#2F353A'
		}
	},
	credits: {
		enabled: 0,
	}

};

// Apply the theme
var highchartsOptions = Highcharts.setOptions(Highcharts.theme);