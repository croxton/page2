#Page2

* Author: [Mark Croxton](http://hallmark-design.co.uk/)

## Version 1.0.0

* Requires: ExpressionEngine 2

## Description

Get an entry id from a page / structure uri, or vice-versa
	
	{!-- get an entry_id from a uri --}
	{exp:page2:id uri="/{segment_1}/{segment_2}/"}
	
	{!-- get a uri from an entry_id --}
	{exp:page2:uri entry_id="143"}