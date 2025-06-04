from flask import Flask, request, jsonify
import requests

app = Flask(__name__)

@app.route('/api/submit', methods=['POST'])
def submit_code():
    try:
        data = request.get_json()
        if not data:
            return jsonify({'error': 'No JSON payload provided'}), 400

        code = data.get('code')
        language = data.get('language')
        input_data = data.get('input', '')

        if not code or not language:
            return jsonify({'error': 'Missing required fields'}), 400

        # Map language to Judge0 language ID
        language_map = {
            'python': 71,
            'javascript': 63
            # Add other languages as needed
        }
        language_id = language_map.get(language.lower())

        if not language_id:
            return jsonify({'error': 'Unsupported language'}), 400

        # Prepare payload for Judge0
        payload = {
            'source_code': code,
            'language_id': language_id,
            'stdin': input_data
        }

        # Send request to Judge0
        response = requests.post(
            'https://judge0-ce.p.rapidapi.com/submissions',
            headers={
                'x-rapidapi-host': 'judge0-ce.p.rapidapi.com',
                'x-rapidapi-key': 'your_api_key_here',
                'content-type': 'application/json'
            },
            json=payload
        )

        response.raise_for_status()  # Raise an exception for HTTP errors

        return jsonify(response.json())

    except requests.exceptions.RequestException as e:
        return jsonify({'error': f'External API request failed: {str(e)}'}), 500
    except Exception as e:
        return jsonify({'error': f'An unexpected error occurred: {str(e)}'}), 500
