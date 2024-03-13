const register = async () => {
    try {
        const form = document.querySelector('.register-ts');
        const formData = new FormData(form);
        console.log(formData.entries().next().value[1])
        const url = 'http://localhost:8000/src/controllers/register.php';

        const response = await fetch(url, {
            method: 'POST',
            body: formData
        });

        if (!response.ok) {
            throw new Error('Hubo un problema al realizar la solicitud.');
        }

        const data = await response.text();
        console.log(data);

    } catch (error) {
        console.error('Error:', error);
    }
}

export default register;
