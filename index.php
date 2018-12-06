<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type"text/css" href="lib/material/material-icons.css">
    <link rel="stylesheet" type"text/css" href="lib/jquery-announce/jquery.announce.css">
    <link rel="stylesheet" type"text/css" href="lib/simpleMDE/simplemde.min.css">

    <script type="text/javascript" src="lib/jquery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="lib/marked/marked.min.js"></script>

    <script type="text/javascript" src="lib/jquery.selection/src/jquery.selection.js"></script>
    <script type="text/javascript" src="lib/jquery-announce/jquery.announce.min.js"></script>
    <script type="text/javascript" src="lib/jquery.caret/jquery.caret.js"></script>
    <script type="text/javascript" src="lib/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="lib/simpleMDE/simplemde.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/litepad.css">

    <script type="text/javascript" src="js/litepad.js"></script>
  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #810541;">
        <div class="container">
          <a class="navbar-brand" href="#" data-toggle="modal" data-target="#modalMove">
            <u>Filename</u>
          </a>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <button class="btn material-icons" data-toggle="modal" data-target="#modalAdd">
                  note_add
                </button>
              </li>
              <li class="nav-item">
                <button class="btn material-icons" data-toggle="modal" data-target="#modalOpen">
                  folder_open
                </button>
                </li>
              <li class="nav-item">
                <button id="btnSave" class="btn material-icons">save</button>
              </li>
              <li class="nav-item">
                <button class="btn material-icons">slideshow</button>
              </li>
              <li class="nav-item">
                <button class="btn material-icons" data-toggle="modal">edit</button>
              </li>
              <li class="nav-item">
                <button class="btn material-icons" data-toggle="modal" data-target="#modalDelete">
                  delete
                </button>
              </li>
              <li class="nav-item">
                <button class="btn material-icons">print</button>
              </li>
              <li class="nav-item">
                <button class="btn material-icons" data-toggle="modal" data-target="#modalSettings">
                  settings
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
            <button id="btnModalAdd" type="button" class="btn btn-warning">Move note</button>
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
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div> 

    <!--modal end -->

    <footer class="fixed-bottom">
      <div class="d-flex justify-content-center">
        <a href="https://github.com/Shadowsith/lpad">Fork me on GitHub!</a>
      </div>
    </footer>
  </body>
</html>
