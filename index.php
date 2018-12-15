<!DOCTYPE html>
<html lang="en">
  <head>
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

    <link rel="stylesheet" type="text/css" href="css/litepad.css">

    <script type="text/javascript" src="js/litepad.js"></script>
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
            <button id="sidebar_close" type="button" class="btn btn-light closebtn material-icons">close</button>
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
          </div>

          <div class="collapse navbar-collapse" id="nav_collapse">
            <ul class="navbar-nav">
              <li class="nav-item">
                <button class="btn material-icons" data-toggle="modal" data-target="#modalAdd"
                  title="adds a note">
                  note_add
                </button>
              </li>
              <li class="nav-item">
                <button class="btn material-icons" data-toggle="modal" data-target="#modalOpen"
                  title="opens a note from note list">
                  folder_open
                </button>
                </li>
              <li class="nav-item">
                <button id="btnSave" class="btn material-icons" title="saves note">save</button>
              </li>
              <li class="nav-item">
                <button id="btnParse" class="btn material-icons" title="parse note">slideshow</button>
              </li>
              <li class="nav-item">
                <button id="btnEdit" class="btn material-icons" data-toggle="modal"
                  title="shows editor">edit</button>
              </li>
              <li class="nav-item">
                <button class="btn material-icons" data-toggle="modal" data-target="#modalDelete"
                  title="deletes open note">
                  delete
                </button>
              </li>
              <li class="nav-item">
                <button id="btnPrint" class="btn material-icons" title="shows pdf print preview">print</button>
              </li>
              <li class="nav-item">
                <button class="btn material-icons" data-toggle="modal" data-target="#modalSettings"
                  title="shows settings">
                  settings
                </button>
              </li>
              <li class="nav-item">
                <button class="btn material-icons" data-toggle="modal" data-target="#modalInfo"
                  title="shows application info">
                  info 
                </button>
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
            <h5 class="modal-title">Add note</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="inModalAdd">Name:</label>
              <input id="inModalAdd" type="text" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id="btnModalAdd" type="button" class="btn btn-primary">Add note</button>
          </div>
        </div>
      </div>
    </div> 

    <div id="modalMove" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Rename note</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="inModalRename">Rename file:</label>
              <input id="inModalRename" type="text" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id="btnModalRename" type="button" class="btn btn-warning">Move note</button>
          </div>
        </div>
      </div>
    </div> 


    <div id="modalOpen" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Open note</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Select a note:</p>
            <ul id="ulNoteOpen">
            </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div> 

    <div id="modalDelete" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete note</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Do you want to delete the open note?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id="btnModalDelete" type="button" class="btn btn-danger">Delete</button>
          </div>
        </div>
      </div>
    </div> 

    <div id="modalSettings" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Note settings</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-sm">
              <tbody>
                <tr>
                  <td title="Enables cookies for users if they have accepted than before">
                    Enable Cookies:
                  </td>
                  <td>
                    <div class="checkbox">
                      <input id="cbCookies"type="checkbox" value="">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td title="max value are 200 notes">
                    Max. number of notes:
                  </td>
                  <td>
                    <div class="form-group">
                      <input id="inNumOfNotes" type="number" class="form-control">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    Pdf Print Font: 
                  </td> 
                  <td>
                    <div class="form-group">
                      <select id="selPdfFont" class="form-control">
                        <option>Courier</option>
                        <option>DejaVu Sans</option>
                        <option>Helvetica</option>
                        <option>Times</option>
                        <option>ZapfDingbats</option>
                      </select>
                    </div> 
                  </td>
                </tr>
              </tbody> 
            </table> 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div> 

    <div id="modalInfo" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-sm">
              <tbody>
                <tr>
                  <td>Developer</td>
                  <td>Philip Mayer</td>
                </tr>
                <tr>
                  <td>Contact</td>
                  <td>philip.mayer@shadowsith.de</td>
                </tr>
                <tr>
                  <td>Year</td>
                  <td>2018-2019</td>
                </tr>
                <tr>
                  <td>License</td>
                  <td><a href="https://opensource.org/licenses/MIT">MIT</a></td>
                </tr>
                <tr>
                  <td>Source Code</td>
                  <td><a href="https://github.com/Shadowsith/lpad">GitHub</a></td>
                </tr>
              </tbody> 
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
