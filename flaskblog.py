from flask import Flask, render_template
app = Flask(__name__)

posts = [
	{
		'author': 'Corey Schafar',
		'title': 'Blog Post 1'
	},
	{
		'author': 'Annisa',
		'title': 'Blog Post 2'
	}
]


@app.route("/")
@app.route("/home")
def home():
	# return "<h1>Home Page</h1>"
	return render_template('home.html', posts=posts)




@app.route("/about")
def about():
	return render_template('about.html')


if __name__ == '__main__':
	app.run(debug=True)