 <!-- Modal -->
 <div class="modal fade" id="deleteModal{{ $buku->slug }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h1 class="modal-title fs-5" id="exampleModalLabel">Buku</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form action="{{ route('destroy-book', ['slug' => $buku->slug]) }}" method="post">
               @csrf
                 <div class="modal-body">
                   Apakah anda yakin ingin menghapus buku ini?
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary">Delete</button>
                 </div>
             </form>
         </div>
     </div>
 </div>
