
// general shit

function toggleAll(cls, enable)
{
	var elems = document.getElementsByClassName(cls);
	for (var i = 0; i < elems.length; i++)
		elems[i].disabled = !enable;
}

function ajaxGet(url, callback)
{
	var x = new XMLHttpRequest();
	x.onreadystatechange = function() 
	{
        if (this.readyState == 4 && this.status == 200) 
		{
            callback(this.responseText);
        }
    };
	x.open('GET', url);
	x.send(null);
}

// post toolbar etc

function wrapSelection(id, before, after)
{
	var textEditor = document.getElementById(id);
	var oldSelS = textEditor.selectionStart;
	var oldSelE = textEditor.selectionEnd;
	var scroll = textEditor.scrollTop;
	var selectedText = textEditor.value.substr(oldSelS, oldSelE - oldSelS);

	textEditor.value = textEditor.value.substr(0, oldSelS) + before + selectedText + after + textEditor.value.substr(oldSelE);

	textEditor.selectionStart = oldSelS + before.length;
	textEditor.selectionEnd = oldSelS + before.length + selectedText.length;
	textEditor.scrollTop = scroll;
	textEditor.focus();
}

function selSurround(id, tag)
{
	wrapSelection(id, '['+tag+']', '[/'+tag+']');
}

function selInsertUrl(id)
{
	var textEditor = document.getElementById(id);
	var oldSelS = textEditor.selectionStart;
	var oldSelE = textEditor.selectionEnd;
	var selectedText = textEditor.value.substr(oldSelS, oldSelE - oldSelS);
	
	if (selectedText && selectedText.substr(0,4).toLowerCase()=='http')
	{
		wrapSelection(id, '[url]', '[/url]');
	}
	else
	{
		var url = prompt('Enter the URL for the link.');
		if (!url) return;
		wrapSelection(id, '[url='+url+']', '[/url]');
	}
}

function easyQuote(text, idvar, id)
{
	text = document.getElementById(text);
	if (!text) return false;
	
	ajaxGet('ajaxcallbacks.php?q'= + id, 
	function(res)
	{
		var selS = text.selectionStart;
		var selE = text.selectionEnd;
		var oldscroll = text.scrollTop;
		var oldtext = text.value;
		
		text.value = 
			oldtext.substr(0, selS) + 
			res +
			oldtext.substr(selS);
			
		text.selectionStart = selS + res.length;
		text.selectionEnd = selE + res.length;
		
		text.scrollTop = oldscroll;
		text.focus();
	});
	return true;
}

// list with funky autocomplete

function showFancyList(field)
{
	var list = field.parentNode.getElementsByClassName('fancylist')[0];
	var search = field.value;
	
	if (search.length < 3)
	{
		hideFancyList(field);
		return;
	}
	
	list.style.display = '';
	
	var listhtml = '';
	ajaxGet('ajax_namesearch.php?q=' + encodeURIComponent(search), 
	function(res)
	{
		if (res.length < 1)
		{
			hideFancyList(field);
			return;
		}
	
		var lines = res.split('\n');
		for (var l = 0; l < lines.length; l++)
		{
			var line = lines[l].trim();
			if (line.length < 1) continue;
			
			listhtml += '<div onclick="chooseNameFromFancyList(this,&quot;'+line+'&quot;);">'+line+'</div>';
		}
		
		list.innerHTML = listhtml;
	});
}

function hideFancyList(field)
{
	var list = field.parentNode.getElementsByClassName('fancylist')[0];
	
	list.style.display = 'none';
}

function lazilyHideFancyList(field)
{
	setTimeout(function(){hideFancyList(field);},200);
}

function chooseNameFromFancyList(d, val)
{
	var field = d.parentNode.parentNode.getElementsByTagName('input')[0];
	field.value = val;
	hideFancyList(field);
}

// poll stuff

function hex2(n)
{
	n = n.toString(16);
	if (n.length < 2) n = '0'+n;
	return n;
}

function addOption()
{
	var color = hex2(Math.floor(Math.random() * 255)) + hex2(Math.floor(Math.random() * 255)) + hex2(Math.floor(Math.random() * 255));
	
	var newdiv = document.createElement('div');
	newdiv.id = 'pollopt'+numopts;
	newdiv.innerHTML = '<input type="text" name="opt'+numopts+'" id="opt'+numopts+'" size=40 maxlength=40 value="">'
             +' - Color: <input class="color" name="color'+numopts+'" id="color'+numopts+'" value="'+color+'">'
			 +' <a href="#" onclick="removeOption(this.parentNode); return false;"><img src="img/delete.png"></a>';

	document.getElementById('polloptions').insertBefore(newdiv, document.getElementById('optend'));
	jscolor.bind();
	
	numopts++;
	document.getElementById('numopts').value = numopts;
}

function removeOption(thediv)
{
	var num = parseInt(thediv.id.substring(7));
	if (num < 1) return;
	if (num >= numopts) return;
	
	document.getElementById('polloptions').removeChild(thediv);
	
	if (num < numopts-1)
	{
		for (i = num+1; i < numopts; i++)
		{
			var newid = i-1;
			
			var elem = document.getElementById('pollopt'+i);
			elem.id = elem.name = 'pollopt'+newid;
			var elem = document.getElementById('opt'+i);
			elem.id = elem.name = 'opt'+newid;
			var elem = document.getElementById('color'+i);
			elem.id = elem.name = 'color'+newid;
		}
	}
	
	numopts--;
	document.getElementById('numopts').value = numopts;
}

// THREAD MOD BAR

function submitMod(action)
{
	document.getElementById('modaction').value = action;
	document.getElementById('modform').submit();
}

function showThreadRename()
{
	document.getElementById('modoptions').style.display = 'none';
	document.getElementById('modrename').style.display = '';
}

function showThreadMove()
{
	document.getElementById('modoptions').style.display = 'none';
	document.getElementById('modmove').style.display = '';
}

function hideThreadEdit()
{
	document.getElementById('modoptions').style.display = '';
	document.getElementById('modrename').style.display = 'none';
	document.getElementById('modmove').style.display = 'none';
}

// PRIVATE CONVERSATION USER LIST SHIZ

function addUser()
{
	var username = document.getElementById('addname').value.trim();
	if (!username) return;
	
	var currnames = document.getElementsByClassName('userlistfields');
	if (currnames.length >= PRIVATE_MAX_USERS)
	{
		alert('You already have '+PRIVATE_MAX_USERS+' users entered.');
		return;
	}
	
	for (var i = 0; i < currnames.length; i++)
	{
		if (currnames[i].value.trim() == username)
		{
			alert('This user was already entered.');
			return;
		}
	}
	
	var newdiv = document.createElement('div');
	newdiv.style.display = 'inline-block';
	
	// need to do shit this way to ensure the entered username is displayed properly regardless of potentially-HTML shit in it
	var label = document.createElement('span'); 
	label.textContent = username;
	
	var input = document.createElement('input'); 
	input.className = 'userlistfields'; 
	input.type = 'hidden'; 
	input.name = 'users[]'; 
	input.value = username;
	
	var extrashit = document.createElement('span');
	extrashit.innerHTML = ' <a href="#" onclick="removeUser(this.parentNode.parentNode); return false;"><img src="img/delete.png" class="linkicon" title="goodbye"></a> &nbsp; &nbsp; ';
	
	newdiv.appendChild(label); 
	newdiv.appendChild(input);
	newdiv.appendChild(extrashit);

	document.getElementById('userlist').appendChild(newdiv);
	
	document.getElementById('addname').value = '';
}

function removeUser(node)
{
	node.parentNode.removeChild(node);
}

var aclFormBackup = document.getElementById('aclform').innerHTML;

function showPrivateAclEdit()
{
	document.getElementById('acl').style.display = 'none';
	document.getElementById('aclform').style.display = '';
	
	aclFormBackup = document.getElementById('aclform').innerHTML;
}

function hidePrivateAclEdit()
{
	document.getElementById('acl').style.display = '';
	document.getElementById('aclform').style.display = 'none';
	
	document.getElementById('aclform').innerHTML = aclFormBackup;
}
