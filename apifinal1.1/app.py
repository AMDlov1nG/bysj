from flask import Flask, request, jsonify
from getapiforme import TodayApiGet

app = Flask(__name__)


@app.route('/login', methods=['POST'])
def login():
    data = request.get_json()

    username = data.get('username', None)

    password = data.get('password', None)

    response_data= TodayApiGet.allapiget(username, password)

    return jsonify(response_data)


if __name__ == '__main__':
    app.run(debug=True)