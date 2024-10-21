async function apiRequest(url, method, fields) {
    try {
        const options = {
            method: method,
            headers: {
                'Authorization': 'SSDFzdg235dsgsdfAsa44SDFGDFDadg',
                'Content-Type': 'application/json',
            }
        };
        if (method !== 'GET') {
            options.body = JSON.stringify(fields);
        }
        const response = await fetch(`http://testfunes.online/${url}`, options);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}