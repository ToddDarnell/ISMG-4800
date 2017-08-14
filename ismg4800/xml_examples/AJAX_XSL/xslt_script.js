// Copyright 2005 Google Inc.
// All Rights Reserved
//
// Tests for the XSLT processor. To run the test, open the file from
// the file system. No server support is required.
//
//
// Author: Steffen Meschkat <mesch@google.com>

logging = true;
xsltdebug = true;

function el(id) {
  return document.getElementById(id);
}

function test_xslt() {
alert('Here');
  var xml = xmlParse(el('xml').innerHTML);
alert('XML gotten');
  var xslt = xmlParse(el('xslt').innerHTML);
alert('XML gotten');
  var html = xsltProcess(xml, xslt);
  //el('html').value = html;
alert('HTML gotten');
  el('content').innerHTML = html;
}

function cleanxml() {
  cleanvalue('xml');
  cleanvalue('xslt');
}

function cleanvalue(id) {
  var x = el(id);
  x.value = x.value.replace(/^\s*/, '').replace(/\n\s*/g, '\n');
}
