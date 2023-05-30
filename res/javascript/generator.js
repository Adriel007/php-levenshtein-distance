function send() {
    const result = document.querySelector("textarea[readonly]");

    const json = {
        str1: document.querySelectorAll("div textarea")[0].value,
        str2: document.querySelectorAll("div textarea")[1].value,
    };

    const file = new Blob([JSON.stringify(json)], { type: 'application/json;charset=utf-8' });
    const formData = new FormData();
    formData.append('file', file);
    fetch('../php/scripts.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            console.log(data)
            data = data.result;

            let str = "Distâncias entre os textos: " + data;
            result.value = str;
        })
        .catch(error => {
            console.error('Erro:', error);
        });
}