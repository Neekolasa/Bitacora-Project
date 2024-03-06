function gestor_recursos(privilegio) 
  {
    if (privilegio=='estandar') 
    {
      $('.admin').css('display', 'none');
      
    }
    else if (privilegio=='admin') 
    {
      $('.admin').css('display', 'block');
    }
    
  }