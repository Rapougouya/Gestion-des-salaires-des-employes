@extends('layouts.temp')
     
@section('content')
     <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Employés</h1>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">							   
							   
							    <div class="col-auto">						    
								    <a class="btn app-btn-secondary" href="{{route('employer.create')}}">
									    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
		                            <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
		                            <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
		                           </svg>
									    Ajouter employé
									</a>
							    </div>
						    </div>
					    </div>
				    </div>
			    </div>

				@if (Session::get('success_message'))
				    <div class="alert alert_success">{{ Session::get('success_message') }}</div>
					
				@endif
			   				
				<div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
							        <table class="table app-table-hover mb-0 text-left">
										<thead>
											<tr>
												<th class="cell">#</th>
												<th class="cell">Departement</th>
												<th class="cell">Nom</th>
												<th class="cell">Prenom</th>
												<th class="cell">Email</th>
												<th class="cell">Contact</th>
												<th class="cell">Salaire</th>
												 <th class="cell">Actions</th> 
											</tr>
										</thead>
										<tbody>

                                            @forelse ($employers as $employer)
                                            <tr>
												<td class="cell">{{$employer->id}}</td>
												<td class="cell">{{$employer->departement->name}}</td>
												<td class="cell"><span class="truncate">{{$employer->firstname}}</span></td>
												<td class="cell">{{$employer->lastname}}</td>
												<td class="cell">{{$employer->email}}</td>
												<td class="cell">{{$employer->phone}}</td>
												<td class="cell"><span class="badge bg-success">{{ $employer->montant_journalier * 31 }} FCFA</span></td>
												
												<td class="cell"><a class="btn-sm app-btn-secondary" href="{{route('employer.edit', $employer->id)}}">Modifier</a>
													<a class="btn-sm app-btn-secondary" href="{{route('employer.delete', $employer->id)}}">Supprimer</a>
												</td>
											</tr>
                                               @empty 
                                               <tr>
												<td class="cell" colspan="6">Aucun employé ajouté</td>
											</tr>
                                            @endforelse 
											
										</tbody>
									</table>
						        </div>
						       
						    </div>		
						</div>
						<div id="search-results">
							
						</div>
						
			        </div>
			        
				</div>
				<script>
					document.getElementById('search-form').addEventListener('submit', function (e) {
						e.preventDefault(); // Empêche la soumission du formulaire par défaut
				
						const searchTerm = document.getElementById('search-input').value.toLowerCase();
						const tableRows = document.querySelectorAll('.app-table-hover tbody tr');
				
						tableRows.forEach((row) => {
							const rowData = row.textContent.toLowerCase();
				
							if (rowData.includes(searchTerm)) {
								row.style.display = 'table-row';
							} else {
								row.style.display = 'none'; 
							}
						});
				        Aucun resultat trouvé
						});
				</script>			
@endsection