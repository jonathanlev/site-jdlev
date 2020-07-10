from flask import Flask, render_template, request
from flask_sqlalchemy import SQLAlchemy
from send_mail import send_mail

app = Flask(__name__)

ENV = 'dev' #sets current database to either production or development database

if ENV == 'dev':
    app.debug = True
    app.config['SQLALCHEMY_DATABASE_URI'] = 'postgresql://postgres:123456@localhost/lexus'
else:
    app.debug = False
    app.config['SQLALCHEMY_DATABASE_URI'] = 'postgres://azwgkxrkicnfea:197c1e848156b11e3c98b5e92abdbbdcaa27888cf5ba127ea368723135956444@ec2-52-6-143-153.compute-1.amazonaws.com:5432/ddsomhe66gmmpt'

app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False

db = SQLAlchemy(app)

class Feedback(db.Model):
    __tablename__ = 'feedback'
    id = db.Column(db.Integer, primary_key=True)
    customer = db.Column(db.String(200), unique=True)
    dealer = db.Column(db.String(200))
    rating = db.Column(db.Integer)
    comments = db.Column(db.Text())

    def __init__(self, customer, dealer, rating, comments):
        self.customer = customer
        self.dealer = dealer
        self.rating = rating
        self.comments = comments

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/#home')
def home():
    return render_template('home.html')

@app.route('/#about')
def aboutme():
    return render_template('about.html')

@app.route('/#resume')
def resume():
    return render_template('resume.html')

@app.route('/#portfolio')
def portfolio():
    return render_template('portfolio.html')

@app.route('/#contact')
def contact():
    return render_template('contact.html')



@app.route('/submit', methods=['POST'])
def submit():
    if request.method == 'POST':
        customer = request.form['customer']
        dealer = request.form['dealer']
        rating = request.form['rating']
        comments = request.form['comments']
        #print(customer, dealer, rating, comments)
        if customer == '' or dealer == '':
            return render_template('contact.html', message = 'Please enter required fields')

        if db.session.query(Feedback).filter(Feedback.customer == customer).count() == 0:
            data = Feedback(customer, dealer, rating, comments)
            db.session.add(data)
            db.session.commit()
            send_mail(customer,dealer,rating,comments)

            return render_template('success.html')
        return render_template('contact.html', message = 'You have already submitted feedback')

if __name__ == '__main__':
    app.run()
