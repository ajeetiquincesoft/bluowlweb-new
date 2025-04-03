<!-- JAVASCRIPT -->
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{ asset('assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{ asset('assets/libs/feather-icons/feather.min.js')}}"></script>
<script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
<script src="{{ asset('assets/js/plugins.js')}}"></script>


 <!-- dropzone min -->
 <script src="{{ asset('assets/libs/dropzone/dropzone-min.js')}}"></script>
 <!-- filepond js -->
 <script src="{{ asset('assets/libs/filepond/filepond.min.js')}}"></script>
 <script src="{{ asset('assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js')}}"></script>
 <script src="{{ asset('assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js')}}"></script>
 <script src="{{ asset('assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js')}}"></script>
 <script src="{{ asset('assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js')}}"></script>

 <script src="{{ asset('assets/js/pages/form-file-upload.init.js')}}"></script>
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 <script src="{{asset('assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js')}}"></script>
     <script src="{{asset('assets/js/pages/form-editor.init.js')}}"></script>
     <script src="{{ asset('assets/js/inputEmoji.js') }}"></script>

     <!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200,
                focus: true
            });
        });
    </script>
        <script>
            const dt = new DataTransfer(); // Permet de manipuler les fichiers de l'input file
    
            $("#formFile").on('change', function(e) {
                for (var i = 0; i < this.files.length; i++) {
                    let fileBloc = $('<span/>', {
                            class: 'file-block'
                        }),
                        fileName = $('<span/>', {
                            class: 'name',
                            text: this.files.item(i).name
                        });
                    fileBloc.append('<span class="file-delete"><span> X </span></span>')
                        .append(fileName);
                    $("#filesList > #files-names").append(fileBloc);
                };
                // Ajout des fichiers dans l'objet DataTransfer
                for (let file of this.files) {
                    dt.items.add(file);
                }
                // Mise à jour des fichiers de l'input file après ajout
                this.files = dt.files;
    
                // EventListener pour le bouton de suppression créé
                $('span.file-delete').click(function() {
                    let name = $(this).next('span.name').text();
                    // Supprimer l'affichage du nom de fichier
                    $(this).parent().remove();
                    for (let i = 0; i < dt.items.length; i++) {
                        // Correspondance du fichier et du nom
                        if (name === dt.items[i].getAsFile().name) {
                            // Suppression du fichier dans l'objet DataTransfer
                            dt.items.remove(i);
                            continue;
                        }
                    }
                    // Mise à jour des fichiers de l'input file après suppression
                    document.getElementById('formFile').files = dt.files;
                });
            });
                $('.old_file_delete').click(function(){
                     $(this).parent().hide();
                          if($('#deletedImg').val()){
                            var old = $('#deletedImg').val() +','+$(this).attr('img');
                          }else{
                            var old = $(this).attr('img');  
                          }
                     $('#deletedImg').val(old);
                });
        </script>



