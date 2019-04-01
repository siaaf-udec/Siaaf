<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <link rel="license" href="http://www.opensource.org/licenses/mit-license/">
    <style type="text/css">
      /* reset */

      *{
        border: 0;
        box-sizing: content-box;
        color: inherit;
        font-family: inherit;
        font-size: inherit;
        font-style: inherit;
        font-weight: inherit;
        line-height: inherit;
        list-style: none;
        margin: 0;
        padding: 0;
        text-decoration: none;
        vertical-align: top;
      }

      /* content editable */

      *[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0;  cursor: pointer; display: inline-block;}

      *[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }

      /*span[contenteditable] { display: inline-block; }*/

      /* heading */

      h1 { font: bold 100% Ubuntu, Arial, sans-serif; text-align: center; text-transform: uppercase; }

      /* table */

      table { font-size: 75%; table-layout: fixed; width: 100%; }
      table { border-collapse: separate; border-spacing: 2px; }
      th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
      th, td { border-radius: 0.25em; border-style: solid; }
      th { background: #EEE; border-color: #BBB; }
      td { border-color: #DDD; }

      /* page */

      html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; }
      html { background: #fff; cursor: default; }

      body { box-sizing: border-box; margin:0;}
      #wrapper{height: 29.7cm; margin: 0 auto; width: 21cm; }
      body { background: #FFF;}

      /* header */

      header { margin: 0 0 3em; }
      header:after { clear: both; content: ""; display: table; }

      header h1 { background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
      header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
      header address p { margin: 0 0 0.25em; }
      header span, header img { display: block; float: right; }
      header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
      header img { max-height: 100%; max-width: 50%; }
      header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

      /* article */

      article, article address, table.meta, table.inventory { margin: 0 0 3em; }
      article:after { clear: both; content: ""; display: table; }
      article h1 { clip: rect(0 0 0 0); position: absolute; }

      article address { float: left; font-size: 125%; font-weight: bold; }

      /* table meta & balance */

      table.meta, table.balance { float: right; width: 36%; }
      table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

      /* table meta */

      table.meta th { width: 40%; }
      table.meta td { width: 60%; }

      /* table items */

      table.inventory { clear: both; width: 100%; }
      table.inventory th { font-weight: bold; text-align: center; }

      table.inventory td:nth-child(1) { width: 26%; }
      table.inventory td:nth-child(2) { width: 38%; }
      table.inventory td:nth-child(3) { text-align: right; width: 12%; }
      table.inventory td:nth-child(4) { text-align: right; width: 12%; }
      table.inventory td:nth-child(5) { text-align: right; width: 12%; }

      /* table balance */

      table.balance th, table.balance td { width: 50%; }
      table.balance td { text-align: right; }

      /* aside */

      aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
      aside h1 { border-color: #999; border-bottom-style: solid; }

      .cutw{position:relative;}
      /* javascript */

      .add, .cut
      {
        border-width: 1px;
        display: block;
        font-size: .8em;
        padding: 0.25em;
        float: left;
        text-align: center;
        width:0.8em;
      }
      .cut{font-size:1em;}

      .add, .cut
      {
        background: #9AF;
        box-shadow: 0 1px 2px rgba(0,0,0,0.2);
        background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
        background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
        border-radius: 0.5em;
        border-color: #0076A3;
        color: #FFF;
        cursor: pointer;
        font-weight: bold;
        text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
      }

      .add { margin: -2.5em 0 0; }

      .add:hover { background: #00ADEE; }

      .cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }

      tr:hover .cut { opacity: 1; }

      @media print {
        * { -webkit-print-color-adjust: exact; }
        html { background: none; padding: 0; }
        body { box-shadow: none; margin: 0; }
        span:empty { display: none; }
        .add, .cut { display: none; }
      }

      @page { margin: 0; }
    </style>
    <script>
      function generateTableRow(){var a=document.createElement("tr");return a.innerHTML='<td><div class="cutw"><a class="cut">-</a></div><span contenteditable></span></td><td><span contenteditable></span></td><td><span data-prefix>$</span><span contenteditable>0.00</span></td><td><span contenteditable>0</span></td><td><span data-prefix>$</span><span>0.00</span></td>',a}function parseFloatHTML(a){return parseFloat(a.innerHTML.replace(/[^\d\.\-]+/g,""))||0}function parsePrice(a){return a.toFixed(2).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g,"$1,")}function updateNumber(a){var b=document.activeElement,c=parseFloat(b.innerHTML),d=b.innerHTML==parsePrice(parseFloatHTML(b));isNaN(c)||38!=a.keyCode&&40!=a.keyCode&&!a.wheelDeltaY||(a.preventDefault(),c+=38==a.keyCode?1:40==a.keyCode?-1:Math.round(.025*a.wheelDelta),c=Math.max(c,0),b.innerHTML=d?parsePrice(c):c),updateInvoice()}function updateInvoice(){for(var b,c,a,d,e,a=0,d=document.querySelectorAll("table.inventory tbody tr"),e=0;d[e];++e)b=d[e].querySelectorAll("span:last-child"),c=parseFloatHTML(b[2])*parseFloatHTML(b[3]),a+=c,b[4].innerHTML=c;b=document.querySelectorAll("table.balance td:last-child span:last-child"),b[0].innerHTML=a,b[2].innerHTML=document.querySelector("table.meta tr:last-child td:last-child span:last-child").innerHTML=parsePrice(a-parseFloatHTML(b[1]));var f=document.querySelector("#prefix").innerHTML;for(d=document.querySelectorAll("[data-prefix]"),e=0;d[e];++e)d[e].innerHTML=f;for(d=document.querySelectorAll("span[data-prefix] + span"),e=0;d[e];++e)document.activeElement!=d[e]&&(d[e].innerHTML=parsePrice(parseFloatHTML(d[e])))}function onContentLoad(){function c(a){var c,b=a.target.querySelector("[contenteditable]");b&&a.target!=document.documentElement&&a.target!=document.body&&b.focus(),a.target.matchesSelector(".add")?document.querySelector("table.inventory tbody").appendChild(generateTableRow()):"cut"==a.target.className&&(c=a.target.ancestorQuerySelector("tr"),c.parentNode.removeChild(c)),updateInvoice()}function d(a){a.preventDefault(),b.classList.add("hover")}function e(a){a.preventDefault(),b.classList.remove("hover")}function f(a){b.classList.remove("hover");var c=new FileReader,d=a.dataTransfer?a.dataTransfer.files:a.target.files,e=0;for(c.onload=g;d[e];)c.readAsDataURL(d[e++])}function g(a){var c=a.target.result;b.src=c}updateInvoice();var a=document.querySelector("input"),b=document.querySelector("img");window.addEventListener&&(document.addEventListener("click",c),document.addEventListener("mousewheel",updateNumber),document.addEventListener("keydown",updateNumber),document.addEventListener("keydown",updateInvoice),document.addEventListener("keyup",updateInvoice),a.addEventListener("focus",d),a.addEventListener("mouseover",d),a.addEventListener("dragover",d),a.addEventListener("dragenter",d),a.addEventListener("blur",e),a.addEventListener("dragleave",e),a.addEventListener("mouseout",e),a.addEventListener("drop",f),a.addEventListener("change",f))}(function(a){for(var f,b=a.head=a.getElementsByTagName("head")[0]||a.documentElement,c="article aside audio bdi canvas data datalist details figcaption figure footer header hgroup mark meter nav output picture progress section summary time video x".split(" "),d=c.length,e=0;d>e;)f=a.createElement(c[++e]);return f.innerHTML="x<style>article,aside,details,figcaption,figure,footer,header,hgroup,nav,section{display:block}audio[controls],canvas,video{display:inline-block}[hidden],audio{display:none}mark{background:#FF0;color:#000}</style>",b.insertBefore(f.lastChild,b.firstChild)})(document),function(a,b,c,d){function e(){}e.prototype.length=c.length,b.matchesSelector=b.matchesSelector||b.mozMatchesSelector||b.msMatchesSelector||b.oMatchesSelector||b.webkitMatchesSelector||function(a){return c.indexOf.call(this.parentNode.querySelectorAll(a),this)>-1},b.ancestorQuerySelectorAll=b.ancestorQuerySelectorAll||b.mozAncestorQuerySelectorAll||b.msAncestorQuerySelectorAll||b.oAncestorQuerySelectorAll||b.webkitAncestorQuerySelectorAll||function(a){for(var b=this,d=new e;b=b.parentElement;)b.matchesSelector(a)&&c.push.call(d,b);return d},b.ancestorQuerySelector=b.ancestorQuerySelector||b.mozAncestorQuerySelector||b.msAncestorQuerySelector||b.oAncestorQuerySelector||b.webkitAncestorQuerySelector||function(a){return this.ancestorQuerySelectorAll(a)[0]||null}}(this,Element.prototype,Array.prototype),window.addEventListener&&document.addEventListener("DOMContentLoaded",onContentLoad);
    </script>
  </head>
  <body>
    <div id="wrapper">
      <header>
        <h1>Invoice</h1>
        <address contenteditable>
          <p>Jonathan Neal</p>
          <p>101 E. Chapman Ave<br>Orange, CA 92866</p>
          <p>(800) 555-1234</p>
        </address>
        <span><img alt="" src="data:image/png;base64,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" /><input type="file" accept="image/*"></span>
      </header>
      <article>
        <h1>Recipient</h1>
        <address contenteditable>
          <p>Some Company<br>c/o Some Guy</p>
        </address>
        <table class="meta">
          <tr>
            <th><span contenteditable>Invoice #</span></th>
            <td><span contenteditable>101138</span></td>
          </tr>
          <tr>
            <th><span contenteditable>Date</span></th>
            <td><span contenteditable>January 1, 2012</span></td>
          </tr>
          <tr>
            <th><span contenteditable>Amount Due</span></th>
            <td><span id="prefix" contenteditable>$</span><span>600.00</span></td>
          </tr>
        </table>
        <table class="inventory">
          <thead>
            <tr>
              <th><span contenteditable>Item</span></th>
              <th><span contenteditable>Description</span></th>
              <th><span contenteditable>Rate</span></th>
              <th><span contenteditable>Quantity</span></th>
              <th><span contenteditable>Price</span></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><a class="cut">-</a><span contenteditable>Front End Consultation</span></td>
              <td><span contenteditable>Experience Review</span></td>
              <td><span data-prefix>$</span><span contenteditable>150.00</span></td>
              <td><span contenteditable>4</span></td>
              <td><span data-prefix>$</span><span>600.00</span></td>
            </tr>
          </tbody>
        </table>
        <a class="add">+</a>
        <table class="balance">
          <tr>
            <th><span contenteditable>Total</span></th>
            <td><span data-prefix>$</span><span>600.00</span></td>
          </tr>
          <tr>
            <th><span contenteditable>Amount Paid</span></th>
            <td><span data-prefix>$</span><span contenteditable>0.00</span></td>
          </tr>
          <tr>
            <th><span contenteditable>Balance Due</span></th>
            <td><span data-prefix>$</span><span>600.00</span></td>
          </tr>
        </table>
      </article>
      <aside>
        <h1><span contenteditable>Additional Notes</span></h1>
        <div contenteditable>
          <p>A finance charge of 1.5% will be made on unpaid balances after 30 days.</p>
        </div>
      </aside>
    </div>
  </body>
</html>
