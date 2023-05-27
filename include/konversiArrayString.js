var checkIfMultiDimentional = function(arr)
	{
	//alert("masuk cek object");		
	for(var item in arr)
		{
		if(typeof(arr[item]) == 'object') { return true; }
		}
		return false;
	}
	
var arrJsToPhp = function(thing, level) // array js format to php format
	{
	//alert("masuk buat data");	
	var jsonString = "";
	if(!level) { level = 0; }
	var start;
	if(typeof(thing) == 'object') {
		if(checkIfMultiDimentional(thing))
			{
			start = 0;
			for(var item in thing)
				{
				var value = thing[item];
				if(start > 0) { jsonString += ','; }

				//if(value.substring) { jsonString += item+":"+value; }
				//else { jsonString += "\""+item+"\":{"+myJsonify(value, level+1)+"}";
				jsonString += "("+arrJsToPhp(value, level+1)+")";
				//}
				start++;
				}
		  }
		  else
			{
			start = 0;
			for(var item in thing)
				{
				if(start > 0){ jsonString +=','; }
				//jsonString += "\""+item+"\":"+thing[item];
				jsonString += thing[item];
				start++;
				}

			return jsonString;
			}
		}
	else { jsonString = thing; }
	return jsonString;
    }
	
var myJsonify = function(thing, level)  // array to json
	{
	var jsonString = "";
	if(!level) { level = 0; }
	var start;
	if(typeof(thing) == 'object') {
		if(checkIfMultiDimentional(thing))
		{
		start = 0;
		for(var item in thing)
			{
			var value = thing[item];
			if(start > 0) { jsonString += ','; }

			if(value.substring) { jsonString += item+":"+value; }
			else { jsonString += "\""+item+"\":{"+myJsonify(value, level+1)+"}"; }
			start++;
			}
		}
		else
			{
			start = 0;
			for(var item in thing)
				{
				if(start > 0){ jsonString +=','; }
				jsonString += "\""+item+"\":"+thing[item];
				start++;
				}

			return jsonString;
			}
		}
	else { jsonString = thing; }
	return jsonString;
}

//usage
//var jsonstr = "{"+myJsonify( multiDimentionalArray )+"}";
//alert(jsonstr);

// ###########################################################

/*
var jsonArg1 = new Object();
    jsonArg1.name = 'calc this';
    jsonArg1.value = 3.1415;
// atau 
var display2 = {};
display2["0"] = "none";
display2["1"] = "block";
display2["2"] = "none";
*/	
var convArrToObj = function(array){
    var thisEleObj = new Object();
    if(typeof array == "object"){
        for(var i in array){
            var thisEle = convArrToObj(array[i]);
            thisEleObj[i] = thisEle;
        }
    }else {
        thisEleObj = array;
    }
    return thisEleObj;
}

// ###########################################################
/*
plArray = new Array();
plArray[1] = new Array(); 
	plArray[1][0]='Test 1 Data'; 
	plArray[1][1]= 'Test 1'; 
	plArray[1][2]= new Array();
		plArray[1][2][0]='Test 1 Data Dets'; 
		plArray[1][2][1]='Test 1 Data Info'; 
plArray[2] = new Array(); 
	plArray[2][0]='Test 2 Data'; 
	plArray[2][1]= 'Test 2';
plArray[3] = new Array(); plArray[3][0]='Test 3 Data'; plArray[3][1]= 'Test 3'; 
plArray[4] = new Array(); plArray[4][0]='Test 4 Data'; plArray[4][1]= 'Test 4'; 
plArray[5] = new Array(); plArray[5]["Data"]='Test 5 Data'; plArray[5]["1sss"]= 'Test 5'; 

document.write("plArray 1,1 : "+plArray[1][1] +"<br />");
//*/

var convertJsArr2Php = function (JsArr){
    var Php = '';
    if (Array.isArray(JsArr)){  
        Php += 'array(';
        for (var i in JsArr){
            Php += '\'' + i + '\' => ' + convertJsArr2Php(JsArr[i]);
            if (JsArr[i] != JsArr[Object.keys(JsArr)[Object.keys(JsArr).length-1]]){
                Php += ', ';
            }
        }
        Php += ')';
        return Php;
    }
    else{
        return '\'' + JsArr + '\'';
    }
}