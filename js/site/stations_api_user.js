var ajax=new http_request();

ajax.set_callback("text","set_status");

do_request=function(){
    var rand=Math.random();
    ajax.get_uri("stations_api_user.php?rand="+rand);
}

set_status=function(result){
    setTimeout("do_request()",180000);
    document.getElementById("card_deck_start").innerHTML=result;
    console.log(result);
}

do_request();



function http_request(){
    //private Eigenschaften...
    var self=this;
    var debug=0;
    var xml_http_request=false;
    var element_array=new Array();
    var callback_array=new Array();
    var var_array=new Array();
    var attribute_array=new Array();

    //globale Eigenschaften...

    //resultat verarbeiten - Callback-Methode...
    var callback=function(){
        //state checken...
        if(xml_http_request.readyState!=4)return;

        //Debug-Ausgabe des Resultats...
        if(debug){
            alert("state/status: "+xml_http_request.readyState+" / "+xml_http_request.status);
            alert("header: "+xml_http_request.getAllResponseHeaders());
            alert("body: "+xml_http_request.responseText);
        }

        //Resultat verarbeiten...
        if(xml_http_request.getResponseHeader("Content-Type")==null){
            return 0;
        }else	if(xml_http_request.getResponseHeader("Content-Type").indexOf("xml")>0){
            get_xmlnode(xml_http_request.responseXML);
        }else{
            get_txtdata(xml_http_request.responseText);
        }
    }

    var init=function(){
        //Mozilla, Opera, Safari sowie Internet Explorer 7
        if(typeof XMLHttpRequest!='undefined'){
            xml_http_request=new XMLHttpRequest();
        }
        if(!xml_http_request){
            //Internet Explorer 6 und älter
            try{
                xml_http_request=new ActiveXObject("Msxml2.XMLHTTP");
            }catch(e){
                try{
                    xml_http_request=new ActiveXObject("Microsoft.XMLHTTP");
                }catch(e){
                    xml_http_request=false;
                }
            }
        }
        //callback bei readystatechange...
        if(xml_http_request){
            xml_http_request.onreadystatechange=callback;
        }else{
            alert("ERROR: XMLHttpRequest not supported");
        }
    }

    //URI senden...
    this.get_uri=function(uri){
        init();
        if(debug)alert("GET: "+uri);
        xml_http_request.open('GET',uri,true);
        xml_http_request.send('');
    }

    //XML-Knoten verarbeiten...
    var get_xmlnode=function(node){
        if(node==null)return;
        //wenn Text-Knoten -> Inhalt anzeigen...
        if(debug)alert(node.nodeName+"|"+node.nodeType+"|"+node.nodeValue);
        if(node.nodeType==3){
            //Textknoten...
            get_result(node.parentNode.nodeName,node.nodeValue);
        }else if(node.nodeType==1){
            if(attribute_array[node.nodeName]){
                for(i=0;i<attribute_array[node.nodeName].length;i++){
                    var attribute_name=attribute_array[node.nodeName][i];
                    if(node.getAttribute(attribute_name)){
                        var attribute_value=node.getAttribute(attribute_name);
                        get_result(node.nodeName+"."+attribute_name,attribute_value);
                    }
                }
            }
        }
        for(var i=0;i<node.childNodes.length;i++){
            if(node.hasChildNodes())get_xmlnode(node.childNodes[i]);
        }
        self.reset();
    }

    //Text-Resultat verarbeiten...
    var get_txtdata=function(text){
        get_result("text",text);
        self.reset();
    }

    //Resultat zurückgeben...
    var get_result=function(result_name,result_value){
        if(debug)alert(result_name+": "+result_value);
        if(var_array[result_name]!=undefined)window[var_array[result_name]]=result_value;
        if(element_array[result_name])document.getElementById(element_array[result_name]).innerHTML=result_value;
        if(typeof window[callback_array[result_name]]=="function")window[callback_array[result_name]](result_value);
    }

    //aktuellen Status zurückgeben... (0=uninitialized, 1=loading, 2=loaded, 3=interactive, 4=complete)
    this.get_state=function(){
        return xml_http_request.readyState;
    }

    //Request beenden...
    this.reset=function(){
        if(debug)alert("RESET");
        xml_http_request.abort();
    }

    //Ausgabeelement setzen...
    this.set_element=function(obj_type,obj_id){
        if(debug)alert("Result Element: "+obj_type+" => "+obj_id);
        var obj_type_array=obj_type.split(".");
        if(obj_type_array.length>1){
            if(attribute_array[obj_type_array[0]]==undefined)attribute_array[obj_type_array[0]]=new Array();
            attribute_array[obj_type_array[0]][attribute_array[obj_type_array[0]].length]=obj_type_array[1];
        }
        element_array[obj_type]=obj_id;
    }

    //externe Callback-Funktion setzen...
    this.set_callback=function(obj_type,function_name){
        if(debug)alert("Callback Function: "+obj_type+" => "+function_name);
        var obj_type_array=obj_type.split(".");
        if(obj_type_array.length>1){
            if(attribute_array[obj_type_array[0]]==undefined)attribute_array[obj_type_array[0]]=new Array();
            attribute_array[obj_type_array[0]][attribute_array[obj_type_array[0]].length]=obj_type_array[1];
        }
        callback_array[obj_type]=function_name;
    }

    //externe Callback-Variable setzen...
    this.set_var=function(obj_type,var_name){
        if(debug)alert("Callback Variable: "+obj_type+" => "+var_name);
        var obj_type_array=obj_type.split(".");
        if(obj_type_array.length>1){
            if(attribute_array[obj_type_array[0]]==undefined)attribute_array[obj_type_array[0]]=new Array();
            attribute_array[obj_type_array[0]][attribute_array[obj_type_array[0]].length]=obj_type_array[1];
        }
        var_array[obj_type]=var_name;
    }

    //debug: value=true -> debuging...
    this.set_debug=function(debug_level){
        debug=debug_level;
    }
}
