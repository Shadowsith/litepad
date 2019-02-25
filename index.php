<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
        if($_SESSION['valid'] == false) {
            header ('Location: login.php');
            exit;
        }
    ?>

    <meta charset="utf-8"/>
    <meta name="description" content="A lightweight webbased noteeditor">
    <meta name="keywords" content="Notes, Editor, Markdown, MIT-License">
    <meta name="author" content="Philip Mayer, 2018-2019">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lpad</title>

    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="lib/material/material-icons.css">
    <link rel="stylesheet" type="text/css" href="lib/jquery-announce/jquery.announce.css">
    <link rel="stylesheet" type="text/css" href="lib/simpleMDE/simplemde.min.css">

    <script type="text/javascript" src="lib/jquery/jquery-3.3.1.min.js"></script>
    <!--<script type="text/javascript" src="lib/marked/marked.min.js"></script>-->

    <script type="text/javascript" src="lib/jquery.selection/src/jquery.selection.js"></script>
    <script type="text/javascript" src="lib/jquery-announce/jquery.announce.min.js"></script>
    <script type="text/javascript" src="lib/jquery.caret/jquery.caret.js"></script>
    <script type="text/javascript" src="lib/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="lib/simpleMDE/simplemde.min.js"></script>
    <script type="text/javascript" src="lib/showdown/showdown.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/lpad.css">

    <script type="text/javascript" src="js/global.js"></script>
    <script type="text/javascript" src="js/i18n.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>
    <script type="text/javascript" src="js/lpad.js"></script>
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #810541;">
        <div id="nav_container" class="container">
          <button id="sidebar_open" class="btn material-icons">view_list</button> 
          <a class="navbar-brand" href="#" data-toggle="modal" data-target="#modalMove">
            <u id="file" title="click to rename note/file">Filename</u>
          </a>
          <div id="sidebar" class="sidenav">
            <button id="sidebar_close" type="button" class="btn btn-light closebtn material-icons">
              close
            </button>
            <a id="s_add" class="s_link" href="#modalAdd" data-toggle="modal">New</a>
            <a id="s_rename" class="s_link" href="#modalMove" data-toggle="modal">Rename</a>
            <a id="s_open" class="s_link" href="#modalOpen" data-toggle="modal">Open</a>
            <a id="s_save" class="s_link" href="#">Save</a>
            <a id="s_parse" class="s_link" href="#">Parse Markdown</a>
            <a id="s_editor" class="s_link" href="#">Show Editor</a>
            <a id="s_print" class="s_link" href="#">Print (PDF)</a>
            <a id="s_delete" class="s_link" href="#modalDelete" data-toggle="modal">Delete</a>
            <a id="s_settings" class="s_link" href="#modalSettings" data-toggle="modal">Settings</a>
            <a id="s_info" class="s_link" href="#modalInfo" data-toggle="modal">Information</a>
            <a id="s_logout" class="s_link" href="./php/logout.php">Logout</a>
          </div>

          <div class="collapse navbar-collapse" id="nav_collapse">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <button id="btnAdd" class="btn material-icons" data-toggle="modal" 
                  data-target="#modalAdd" title="adds a note">
                  note_add
                </button>
              </li>
              <li class="nav-item">
                <button id="btnOpen" class="btn material-icons" data-toggle="modal" 
                  data-target="#modalOpen" title="opens a note from note list">
                  folder_open
                </button>
                </li>
              <li class="nav-item">
                <button id="btnSave" class="btn material-icons" title="saves note">
                  save
                </button>
              </li>
              <li class="nav-item">
                <button id="btnParse" class="btn material-icons" title="parse note">
                  slideshow
                </button>
              </li>
              <li class="nav-item">
                <button id="btnEdit" class="btn material-icons" data-toggle="modal"
                  title="shows editor">edit</button>
              </li>
              <li class="nav-item">
                <button id="btnDelete" class="btn material-icons" data-toggle="modal" 
                  data-target="#modalDelete" title="deletes open note">
                  delete
                </button>
              </li>
              <li class="nav-item">
                <button id="btnPrint" class="btn material-icons" title="shows pdf print preview">
                  print
                </button>
              </li>
              <li class="nav-item">
                <button id="btnSettings" class="btn material-icons" data-toggle="modal" 
                  data-target="#modalSettings" title="shows settings">
                  settings
                </button>
              </li>
              <li class="nav-item">
                <button id="btnInfo" class="btn material-icons" data-toggle="modal" 
                  data-target="#modalInfo" title="shows application info">
                  info 
                </button>
              </li>
            </ul>
            <ul class="navbar-nav">
              <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
              </li>
           </ul>
          </div>
        </div>
      </nav>   
    </header> 

    <div id="content" class="container">
        <textarea id="editor"></textarea>
    </div>

    <div id="parsed" class="container mt-2">

    </div>

    <!--modal area -->
    <div id="modalAdd" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="h5ModalAdd" class="modal-title">Add note</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label id="lblModalAdd" for="inModalAdd">Name:</label>
              <input id="inModalAdd" type="text" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btnModalClose" data-dismiss="modal">
              Close
            </button>
            <button id="btnModalAdd" type="button" class="btn btn-primary">Add note</button>
          </div>
        </div>
      </div>
    </div> 

    <div id="modalMove" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="h5ModalRename" class="modal-title">Rename note</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label id="lblModalRename" for="inModalRename">Rename file:</label>
              <input id="inModalRename" type="text" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btnModalClose" data-dismiss="modal">
              Close
            </button>
            <button id="btnModalRename" type="button" class="btn btn-warning">Move</button>
          </div>
        </div>
      </div>
    </div> 


    <div id="modalOpen" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="h5ModalOpen" class="modal-title">Open note</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <label id="lblModalOpen">Select a note:</label>
            <ul id="ulNoteOpen">
            </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btnModalClose" data-dismiss="modal">
              Close
            </button>
          </div>
        </div>
      </div>
    </div> 

    <div id="modalDelete" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="h5ModalDelete" class="modal-title">Delete note</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <label id="lblModalDelete">Do you want to delete the open note?</label>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btnModalClose" data-dismiss="modal">
              Close
            </button>
            <button id="btnModalDelete" type="button" class="btn btn-danger">Delete</button>
          </div>
        </div>
      </div>
    </div> 

    <div id="modalSettings" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="h5ModalSettings" class="modal-title">Note settings</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row list">
              <div class="col-5 list-item">
                <div id="lblCookies" class="list-content">
                  Enable Cookies:  
                </div>
              </div> 
              <div class="col-7 list-item">
                <div class="checkbox list-content">
                  <input id="cbCookies" type="checkbox" value="">
                </div>
              </div>
            </div>
            <div class="row list">
              <div class="col-5 list-item">
                <div id="lblMaxNotes" class="list-content">
                  Max. number of notes:
                </div>
              </div>
              <div class="col-7 list-item">
                <div class="form-group list-content">
                  <input id="inMaxNotes" type="number" class="form-control">
                </div>
              </div>
            </div>
            <div class="row list">
              <div class="col-5 list-item">
                <div id="lblPdfPrint" class="list-content">
                  Pdf print font: 
                </div>
              </div>
              <div class="col-7 list-item">
                <div class="form-group list-content">
                  <select id="selPdfFont" class="form-control">
                    <option value="Courier">Courier</option>
                    <option value="DejaVu Sans">DejaVu Sans</option>
                    <option value="Helvetica">Helvetica</option>
                    <option value="Times">Times</option>
                    <option value="ZapfDingbats">ZapfDingbats</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row list">
              <div class="col-5 list-item">
                <div id="lblLang" class="list-content">
                  Language:
                </div>
              </div>
              <div class="col-7 list-item">
                <div class="form-group list-content">
                  <select id="selLang" class="form-control">
                    <option value="EN">EN</option>
                    <option value="DE">DE</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btnModalClose" data-dismiss="modal">
              Close
            </button>
            <button id="btnModalSave" type="button" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </div> 

    <div id="modalInfo" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 id="h5ModalInfo" class="modal-title">Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row list">
              <div class="col-5 list-item">
                <div id="lblDeveloper" class="list-content">
                  Developer
                </div>
              </div> 
              <div class="col-7 list-item">
                <div class="list-content">
                  Philip Mayer
                </div>
              </div>
            </div>
            <div class="row list">
              <div class="col-5 list-item">
                <div id="lblContact" class="list-content">
                  Contact
                </div>
              </div> 
              <div class="col-7 list-item">
                <div class="list-content">
                  philip.mayer@shadowsith.de
                </div>
              </div>
            </div>
            <div class="row list">
              <div class="col-5 list-item">
                <div id="lblDevYear" class="list-content">
                  Year
                </div>
              </div> 
              <div class="col-7 list-item">
                <div class="list-content">
                  2018-2019
                </div>
              </div>
            </div>
            <div class="row list">
              <div class="col-5 list-item">
                <div id="lblLicense" class="list-content">
                  License
                </div>
              </div> 
              <div class="col-7 list-item">
                <div class="list-content">
                  <a href="https://opensource.org/licenses/MIT">MIT</a>
                </div>
              </div>
            </div>
            <div class="row list">
              <div class="col-5 list-item">
                <div id="lblSourceCode" class="list-content">
                  Source code
                </div>
              </div> 
              <div class="col-7 list-item">
                <div class="list-content">
                  <a href="https://github.com/Shadowsith/lpad">
                    GitHub
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btnModalClose" data-dismiss="modal">
              Close
            </button>
          </div>
        </div>
      </div>
    </div> 


    <!--modal end -->
    <footer class="fixed-bottom">
      <div id="fork" class="d-flex justify-content-center">
        <a href="https://github.com/Shadowsith/lpad">Fork me on GitHub!</a>
      </div>
    </footer>
  </body>
</html>
