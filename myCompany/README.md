# MyCompany - a contao modul that allows you to manage your website company datas with ease #

## Insert tags ##
The MyC Module comes with a lot of insert tags for your company and your staff member so you never have to repeat yourself.

### For Company ###
You can easily use company insert tags by writting {{c_myCompanyShorthandle::getSomething}}. For example your company has the shorthandle bozi and you like to get the name, just write {{c_bozi::name}}.

#### Posible tags ####

`{{c_myCompanyShorthandle::name}}`

Get the name of the company

`{{c_myCompanyShorthandle::zip}}`

Get the zip code of a company

`{{c_myCompanyShorthandle::city}}`

Get the city of a company

`{{c_myCompanyShorthandle::street}}`

Get the street of a company

`{{c_myCompanyShorthandle::mail}}`

Get the html formated hyperlinked mail address of the company

`{{c_myCompanyShorthandle::mailPlain}}`

Get the plain mail adress of the company

`{{c_myCompanyShorthandle::phone}}`

Get the phone number of the company. build by the basic number and the global direct number

`{{c_myCompanyShorthandle::phoneBase}}`

returns the basic number without direct dial

`{{c_myCompanyShorthandle::fax}}`

Returns the fax number

`{{c_myCompanyShorthandle::address}}`

Returns the hole address formated with html (name, street, zip and street)

`{{c_myCompanyShorthandle::contact}}`

Returns an html formated contact (mail, phone and fax) with labels

`{{c_myCompanyShorthandle::contactNoLabel}}`

Returns an html formated contact (mail, phone and fax) without labels