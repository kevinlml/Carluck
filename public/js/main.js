const articles = document.getElementById('ads');

if(ads){
    ads.addEventListener('click', e => {
        if(e.target.className === 'btn btn-danger delete-article'){
            if(confirm('are you sure?'))
            {
                const id = e.target.getAttribute('data-id');
                fetch(`/user/delete/${id}`, { method: 'DELETE'}).then(res=> window.location.reload());

            }
        }
    });
}