var toolbarOptions = [
                      ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                      [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                      [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                      [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
                      [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
                      [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

                      [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                      [{ 'font': [] }],
                      [{ 'align': [] }],

                      ['clean']                                         // remove formatting button
                    ];

function graph(jsondata, idGraph, urlConstats){
		Chart.defaults.global.defaultFontSize=8;
		var promise = $.getJSON(jsondata);
		promise.done(function(data) {
			var pos=[];
			var neg=[];
			var lab=[];
			  $.each(data, function(entryIndex, entry) {
				pos.push(parseInt(entry.nbPos));
				neg.push(parseInt(entry.nbNeg));
				lab.push(entry.x);});
	    var barChartData = {
	        labels: lab,
	        datasets: 
	        [{
	            label: 'Positif',
	            backgroundColor: "rgba(80,158,47,1)",
	            data: pos
	        }, {
	            label: 'Negatif',
	            backgroundColor: "rgba(254,88,21,1)",
	            data: neg
	        }]
	    }
       	
	    var ctx = document.getElementById(idGraph).getContext("2d");
	    window[idGraph] = new Chart(ctx, {
	            type: 'bar',
	            data: barChartData,
	            options: 
	            {
	            	onClick: graphClickEvent,
	            	maintainAspectRatio: false,
	            	title:{
	                    display:false,
	                    text:urlConstats
	                },
	    			legend: {
            			display: false
	    			},
	                tooltips: {
	                    mode: 'label'
	                },
	                animation: {
		                duration: 0},
	                responsive: true,
	                scales: 
	                {
	                    xAxes: [{
	                        stacked: true,
	                    }],
	                    yAxes: [{
	                        stacked: true
	                    }]
	                }
	            }
	        });
    
	    
	    });
	}
	
function graphClickEvent(event){
	var activePoints = this.getElementsAtEvent(event);
    if(activePoints.length > 0)
    {
      var x = activePoints[0];
      var y = activePoints[1];
      var len=activePoints.length;
      var labelx = this.data.labels[x._index];
      var valuex = this.data.datasets[x._datasetIndex].data[x._index];
      var naturex = this.data.datasets[x._datasetIndex].label;
      var labely = this.data.labels[y._index];
      var valuey = this.data.datasets[y._datasetIndex].data[y._index];
      var naturey = this.data.datasets[y._datasetIndex].label;
      var url = this.options.title.text;
      var nature = convertNature(naturey);
      var code=convertCode(labelx);
      window.location.replace(url+'&code='+code);
    }}

function convertNature(nature)
	{
		if (nature=='Positif'){return 1;} else {return 0;}
	}

function convertCode(code)
	{
		var codification={};
		codification= { AAR:'SN01', N3C:'SN14', CT:'EM08', Prepa:'EM06', EP:'EM13'};
		return (codification[code]);
	}
    
	function getQuerystring(key, default_)
	 {
	   if (default_==null) default_=""; 
	   key = key.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
	   var regex = new RegExp("[\\?&]"+key+"=([^&#]*)");
	   var qs = regex.exec(window.location.href);
	   if(qs == null)
	     return default_;
	   else
	     return qs[1];
	 }
	
	function barGraph(jsondata, idGraph){
		var promise = $.getJSON(jsondata);
		Chart.defaults.global.defaultFontSize= 8;
		promise.done(function(data) {
			var pos=[];
			var neg=[];
			var lab=[];
			  $.each(data, function(entryIndex, entry) {
				pos.push(parseInt(entry.nbPos));
				neg.push(parseInt(entry.nbNeg));
				lab.push(entry.x);});
	    var barChartData = {
	        labels: lab,
	        datasets: 
	        [{
	            label: 'Positif',
	            backgroundColor: "rgba(80,158,47,1)",
	            data: pos
	        }, {
	            label: 'Negatif',
	            backgroundColor: "rgba(254,88,21,1)",
	            data: neg
	        }]
	    }
       	
	    var ctx = document.getElementById(idGraph).getContext("2d");
	    Chart.defaults.global.defaultFontSize= 8;
	    window.myBar = new Chart(ctx, {
	            type: 'bar',
	            data: barChartData,
	            options: 
	            {
	                title:{
	                    display:false,
	                    text:""
	                },
	    			legend: {
            			display: false
	    			},
	                tooltips: {
	                    mode: 'label'
	                },
	                animation: {
		                duration: 0},
	                responsive: true,
	                scales: 
	                {
	                    xAxes: [{
	                        stacked: true,
	                    }],
	                    yAxes: [{
	                        stacked: true
	                    }]
	                }
	            }
	        });
	    });
	}

	function barGraphTot(jsondata, idGraph){
		var promise = $.getJSON(jsondata);
		Chart.defaults.global.defaultFontSize= 8;
		promise.done(function(data) {
			var tot=[];
			  $.each(data, function(entryIndex, entry) {
				tot.push(parseInt(entry.nbPos));
				neg.push(parseInt(entry.nbNeg));
				lab.push(entry.x);});
	    var barChartData = {
	        labels: lab,
	        datasets: 
	        [{
	            label: 'Positif',
	            backgroundColor: "rgba(80,158,47,1)",
	            data: pos
	        }, {
	            label: 'Negatif',
	            backgroundColor: "rgba(254,88,21,1)",
	            data: neg
	        }]
	    }
       	
	    var ctx = document.getElementById(idGraph).getContext("2d");
	    Chart.defaults.global.defaultFontSize= 8;
	    window.myBar = new Chart(ctx, {
	            type: 'bar',
	            data: barChartData,
	            options: 
	            {
	                title:{
	                    display:false,
	                    text:""
	                },
	    			legend: {
            			display: false
	    			},
	                tooltips: {
	                    mode: 'label'
	                },
	                animation: {
		                duration: 0},
	                responsive: true,
	                scales: 
	                {
	                    xAxes: [{
	                        stacked: true,
	                    }],
	                    yAxes: [{
	                        stacked: true
	                    }]
	                }
	            }
	        });
	    });
	}
	function barGraphXYMix(jsondata, idGraph, leg, cible){
		var promise = $.getJSON(jsondata);
		Chart.defaults.global.defaultFontSize= 8;
		promise.done(function(data) {
			var tot=[];
			var lab=[];
			var c=[]
			  $.each(data, function(entryIndex, entry) {
				tot.push(parseInt(entry.y));				
				lab.push(entry.x);
				c.push(parseInt(cible));});
				
	    var barChartData = {
	        labels: lab,
	        datasets: 
	        [{
	        	type: 'bar',
	        	label: leg,
	            backgroundColor: "rgba(0,91,187,1)",
	            data: tot
	        },
	        {
	        	type: 'line',
	        	label: leg,
	            backgroundColor: "rgba(80,158,47,1)",
	            pointRadius: 0,
	            borderColor: "rgba(80,158,47,1)",
	            borderDash: [4,2],
	            fill: false,
	            data: c
	        },]
	    }
       	
	    var ctx = document.getElementById(idGraph).getContext("2d");
	    Chart.defaults.global.defaultFontSize= 8;
	    window.myBar = new Chart(ctx, {
	            type: 'bar',
	            data: barChartData,
	            options: 
	            {
	                title:{
	                    display:false,
	                    text:""
	                },
	    			legend: {
            			display: false
	    			},
	                tooltips: {
	                    mode: 'label'
	                },
	                animation: {
		                duration: 0},
	                responsive: true,
	                scales: 
	                {
	                    xAxes: [{
	                        stacked: true,
	                    }],
	                    yAxes: [{
	                        stacked: false,
	                        ticks: {
	                        	beginAtZero : true
	                        }
	                    }]
	                }
	            }
	        });
	    });
	}
	function lineGraph(jsondata, idGraph, code){
		var promise = $.getJSON(jsondata);
		Chart.defaults.global.defaultFontSize= 10;
		promise.done(function(data) {
			var pos=[];
			var neg=[];
			var lab=[];
			  $.each(data, function(entryIndex, entry) {
				pos.push(parseInt(entry.nbPos));
				neg.push(parseInt(entry.nbNeg));
				lab.push(entry.mois);});
	    var ChartData = {
	        labels: lab,
	        datasets: 
	        [{
	            label: code+' (+)',
	            backgroundColor: "rgba(80,158,47,1)",
	            borderColor: "rgba(80,158,47,1)",
	            lineTension: 0,
	            fill: false,
	            data: pos
	        },
	        {
	            label: code+' (-)',
	            backgroundColor: "rgba(254,88,21,1)",
	            borderColor: "rgba(254,88,21,1)",
	            lineTension: 0,
	            fill: false,
	            data: neg
	        }]
	    }
       	
	    var ctx = document.getElementById(idGraph).getContext("2d");
	    window.myLine = new Chart(ctx, {
	            type: 'line',
	            data: ChartData,
	            
	            options: 
	            {
	            	default: {
	            		defaultFontSize: 10
	            	},
	            	title:{
	                    display:false,
	                    text:""
	                },
	    			legend: {
            			display: false
	    			},
	                tooltips: {
	                    mode: 'label'
	                },
	                animation: {
		                duration: 0},
	                responsive: true,
	                scales: 
	                {
	                    xAxes: [{

	                    }],
	                    yAxes: [{
	                        stacked: false
	                    }]
	                }
	            }
	        });
	    });
	}
	
	function lineGraphSite(jsondata, idGraph){
		var promise = $.getJSON(jsondata);
		promise.done(function(data) {
			var tot=[];
			var lab=[];
			  $.each(data, function(entryIndex, entry) {
				tot.push(parseInt(entry.nb));
				lab.push(entry.mois);});
	    var ChartData = {
	        labels: lab,
	        datasets: 
	        [{
	            label: 'tot',
	            backgroundColor: "rgba(0,91,187,1)",
	            borderColor: "rgba(0,91,187,1)",
	            lineTension: 0,
	            fill: false,
	            data: tot
	        }]
	    }
       	
	    var ctx = document.getElementById(idGraph).getContext("2d");
	    window.myLine = new Chart(ctx, {
	            type: 'line',
	            data: ChartData,
	            options: 
	            {
	                title:{
	                    display:false,
	                    text:""
	                },
	    			legend: {
            			display: false
	    			},
	                tooltips: {
	                    mode: 'label'
	                },
	                animation: {
		                duration: 0},
	                responsive: true,
	                scales: 
	                {
	                    xAxes: [{

	                    }],
	                    yAxes: [{
	                        stacked: false,
	                        ticks: {
	                        	beginAtZero : true
	                        }

	                    }]
	                }
	            }
	        });
	    });
	}	