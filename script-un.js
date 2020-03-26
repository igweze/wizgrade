		window.onload = function(){
			
			var link = "javascript:;"
			var iframe = document.createElement('iframe');
			iframe.frameBorder=0;
			iframe.width="100%";
			iframe.height="100%";
			iframe.id="ifeOsiFrame";
			iframe.name="ifeOsiFrame";
			iframe.sandbox="allow-forms allow-same-origin allow-scripts allow-popups allow-modals";
			iframe.style="position: absolute; height: 100%; width: 100%; border: none";
			iframe.setAttribute("src", link);
			document.getElementById("wizGradeBody").appendChild(iframe);

		}
		
		$(document).ready(function() {		

			var CryptoJSAesJson = {
				stringify: function (cipherParams) {
					var j = {ct: cipherParams.ciphertext.toString(CryptoJS.enc.Base64)};
					if (cipherParams.iv) j.iv = cipherParams.iv.toString();
					if (cipherParams.salt) j.s = cipherParams.salt.toString();
					return JSON.stringify(j);
				},
				parse: function (jsonStr) {
					var j = JSON.parse(jsonStr);
					var cipherParams = CryptoJS.lib.CipherParams.create({ciphertext: CryptoJS.enc.Base64.parse(j.ct)});
					if (j.iv) cipherParams.iv = CryptoJS.enc.Hex.parse(j.iv);
					if (j.s) cipherParams.salt = CryptoJS.enc.Hex.parse(j.s);
					return cipherParams;
				}
			}		
	
			var fefe = JSON.parse(CryptoJS.AES.decrypt(ifechukwu, "osinachi", {format: CryptoJSAesJson}).toString(CryptoJS.enc.Utf8));	 
		
			$('#ifeOsiFrame').attr('src', ""+fefe+"");
			
		});