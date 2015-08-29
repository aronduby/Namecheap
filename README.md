# Overview #

This is library for the Namecheap API. It supports all of the latest namecheap API methods and is installable using composer. Started off as just a fork of [Humen/Namecheap](https://github.com/Humen/Namecheap) but I ended up making a whole lot of breaking changes including how you interact with the class and the parser so switching to it's own repo.

## Requirements ##

* PHP 5.3.0 or greater

## Installation ##

To install Namecheap, use the following composer require statement:

```
    "require": {
        "aronduby/namecheap": "dev-master"
    }
```

## Usage ##

```php
require 'vendor/autoload.php';

$api_user = 'YOUR-API-USERNAME';
$api_key = 'YOUR-API-KEY';
$client_ip = 'YOUR-IP-ADDRESS';
$sandbox = true;

$namecheap = new Namecheap\Wrapper($api_user, $api_key, $client_ip, $sandbox);
$response = $namecheap->domains()->getTldList();

if($response->success === true){
	$response->getData();
} else {
	$response->getErrors();
}
```

### Parser ###
The XML to Array parsing is done via [this function from Outlandish blog](http://outlandish.com/blog/xml-to-json/). The nodes, starting at CommandResponse, will be returned as nested associative arrays where the node name is a key, attributes are prefixed with `@` and the text value is `$`.

So this call:
```php
$rsp = $namecheap->domains()->dns()->getEmailForwarding(['DomainName' => 'test.com']);
```

results in the following XML from `$rsp->getRaw()`:
```xml
<?xml version="1.0" encoding="utf-8"?>
<ApiResponse Status="OK" xmlns="http://api.namecheap.com/xml.response">
 <Errors />
 <Warnings />
 <RequestedCommand>namecheap.domains.dns.getEmailForwarding</RequestedCommand>
 <CommandResponse Type="namecheap.domains.dns.getEmailForwarding">
   <DomainDNSGetEmailForwardingResult Domain="test.com">
     <Forward mailboxid="19935" mailbox="info">test@gmail.com</Forward>
     <Forward mailboxid="19936" mailbox="webmaster">test@grcmc.org</Forward>
   </DomainDNSGetEmailForwardingResult>
 </CommandResponse>
 <Server>PHX01SBAPI01</Server>
 <GMTTimeDifference>--4:00</GMTTimeDifference>
 <ExecutionTime>1.379</ExecutionTime>
</ApiResponse>
```

which results in the follow array from `$rsp->getData()`:
```php
[
 "@Type" => "namecheap.domains.dns.getEmailForwarding",
 "DomainDNSGetEmailForwardingResult" => [
   [
     "@Domain" => "test.com",
     "Forward" => [
       [
         "@mailboxid" => "19935",
         "@mailbox" => "info",
         "$" => "test@gmail.com",
       ],
       [
         "@mailboxid" => "19936",
         "@mailbox" => "webmaster",
         "$" => "test@gmail.com",
       ],
     ],
   ],
 ],
]
```

If you prefer to work directly with the `SimpleXml` object just call `$response->getXml()`



## TODO ##
* Write unit tests
* Write DTOs to enforce strictness in calls

## License ##
The MIT License (MIT)

Copyright (c) 2013 Vouga Labs

Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.