# lpad
A lightweight webbased notepad with markdown support

---
<img src="https://shadowsith.de/samples/lpad.png" alt="Example" height="400" width="auto">

---

## Requirements
lpad requires only **PHP** and (soon) MySQL installed on your webserver.<br>
Bootstrap, jQuery and all other libraries are included by default. See below for more information.

## Features
This application is under active development and needs some time for the first release version

### Implemented
* Mobile and desktop support
* Create/save/open notes
* Markdown support and viewer
* Switches dynamically between desktop buttons and app menu if browser window is to small
* split screen editor for non mobile devices (texteditor and markdown view side by side)

### Todo
* login
* switch from text files to mysql db

### In later versions
* change UI colors/colorschemes

## Where will my notes be saved?
* The notes will be saved as simple textfiles under lpad/notes

## Demo
https://lpad.shadowsith.de

## Used libraries
* [Bootstrap 4.1](https://getbootstrap.com/docs/4.1/getting-started/introduction/)
* [jQuery 3.3.1](https://jquery.com/)
* [Google Material Icons](https://material.io/tools/icons/)
* [jquery-announce](https://github.com/claviska/jquery-announce.git)
* [jquery.selection](http://madapaja.github.io/jquery.selection/)
* [Showdownjs](https://github.com/showdownjs/showdown)
* [SimpleMDE](https://github.com/sparksuite/simplemde-markdown-editor)

## Third party requirements
I recommend to use the install_third_party.sh
* [Dompdf](https://github.com/dompdf/dompdf)

