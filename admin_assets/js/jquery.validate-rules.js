	$(document).ready(function() {
			
				jQuery.validator.addMethod("lettersonly", function(value, element) {
					return this.optional(element) || /^[a-z]+$/i.test(value);
					}, "Please enter only letters"); 
					
					
			
                $("#login-form").validate({
			
                         errorElement: "span", 
			 errorClass:"inputError",
			 successClass:"inputSuccess",
			 
			 
			//set the rules for the fild names
			rules: {
			
				
				email: {
					required: true,
					email: true
				},
				password: {
					required: true,
					minlength: 6,
					maxlength:50
				},
				
				
				
			},
			//set messages to appear inline
			messages: {
			
				
				
				password: {
				required: " ",
				minlength: " ",
				maxlength: " "
				},
				
				
				
				email: " ",
				
				
				
			},
			
                        errorPlacement: function(error, element) {               
					error.appendTo(element.parent());     
				},
				 highlight: function(element) {
                            $(element).closest('.input-group').removeClass('has-success').addClass('has-error');
                            },
                             success: function(element) {
                            element.closest('.input-group').removeClass('has-error').addClass('has-success');
                            }

		});
                
                
                
                $("#ques-import").validate({
			
                         errorElement: "label", 
			 errorClass:"inputError",
			 successClass:"inputSuccess",
			 
			 
			//set the rules for the fild names
			rules: {
			
				
				boardId: {
					required: true,					
				},
				classId: {
					required: true,					
				},
                                subjectId: {
					required: true,					
				},
				chapterId: {
					required: true,					
				},
                                questionTypeId: {
					required: true,					
				},
				questionLevelId: {
					required: true,					
				},
				
				
				
			},
			//set messages to appear inline
			messages: {
			
				
				
				boardId: {
				required: "",
				},
				classId: {
                                 required:" ",
                                },
                                subjectId: {
				required: " ",
				},
				chapterId: {
                                 required:" ",
                                },
                                questionTypeId: {
				required: " ",
				},
				questionLevelId: {
                                 required:" ",
                                },
				
				
				
			},
			
                            errorPlacement: function(error, element) {               
					error.appendTo(element.parent());     
				},
				 highlight: function(element) {
                            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                            },
                             success: function(element) {
                            element.closest('.form-group').removeClass('has-error').addClass('has-success');
                            }

		});
                
                
                $("#question-form").validate({
			
                         errorElement: "label", 
			 errorClass:"inputError",
			 successClass:"inputSuccess",
			 ignoreTitle: true,
			 
			//set the rules for the fild names
                         ignore: [],
                        debug: false,
			rules: {
			
				
				questionPoint: {
					required: true,					
				},
				questionLevel: {
					required: true,					
				},
                                questionChapter: {
					required: true,					
				},
				quetionActualTime: {
					required: true,	               
                                        number:true,
				},
                                
                                questionTitle:{
                                    required: function() 
                                   {
                                    CKEDITOR.instances.questionTitle.updateElement();
                                   },
                                   required: true,	
                                },
				
				
				
			},
			//set messages to appear inline
			messages: {
			
				
				
				questionPoint: {
				required: "",
				},
				questionLevel: {
                                 required:" ",
                                },
                                questionChapter: {
				required: " ",
				},
				quetionActualTime: {
                                 required:" ",
                                },
                                
                                questionTitle:{
                                    required: "Please enter the question" ,
                                }
				
				
				
			},
			
                        errorPlacement: function(error, element) {
                            error.html('');
                            if(element.closest('.form-group').find('label.error').length == 0){
                              error.insertBefore( element.closest('.form-group').find('.error_message_holder') );
                            }
                          },
				 highlight: function(element) {
                            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                            },
                             success: function(element) {
                            element.closest('.form-group').removeClass('has-error').addClass('has-success');
                            }

		});

		
	});