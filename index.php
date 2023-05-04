#initialize the coach seats
coach_seats = [[0 for j in range(7)] for i in range(11)]
coach_seats[10] = [0 for j in range(3)]

def reserve_seats(num_seats):
    # search for consecutive seats in a row
    for i in range(len(coach_seats)):
        consecutive_seats = 0
        start_seat = -1
        for j in range(len(coach_seats[i])):
            if coach_seats[i][j] == 0:
                if consecutive_seats == 0:
                    start_seat = j
                consecutive_seats += 1
            else:
                consecutive_seats = 0
                start_seat = -1
            if consecutive_seats == num_seats:
                for k in range(start_seat, start_seat + num_seats):
                    coach_seats[i][k] = 1
                return [i+1, list(range(start_seat+1, start_seat+num_seats+1))]
                
    # if consecutive seats are not available in a row, search for nearby seats
    for i in range(len(coach_seats)):
        for j in range(len(coach_seats[i])):
            if coach_seats[i][j] == 0:
                booked_seats = [[i+1, [j+1]]]
                for k in range(1, num_seats):
                    if j+k < len(coach_seats[i]) and coach_seats[i][j+k] == 0:
                        booked_seats[-1][1].append(j+k+1)
                    else:
                        if i+k >= len(coach_seats):
                            break
                        consecutive_seats = True
                        for l in range(len(booked_seats[-1][1])):
                            if coach_seats[i+k][booked_seats[-1][1][l]-1] == 1:
                                consecutive_seats = False
                                break
                        if consecutive_seats:
                            booked_seats.append([i+k+1, booked_seats[-1][1]])
                        else:
                            break
                if len(booked_seats) == num_seats:
                    for seat in booked_seats:
                        for k in range(len(seat[1])):
                            coach_seats[seat[0]-1][seat[1][k]-1] = 1
                    return [booked_seats[0][0], booked_seats[0][1


                    class TrainCoach:
    def __init__(self, rows, seats_per_row):
        self.rows = rows
        self.seats_per_row = seats_per_row
        self.coach = [[0 for i in range(seats_per_row)] for j in range(rows)]
        self.booked_seats = []

    def book_seats(self, num_seats):
        seats_booked = []
        for i in range(self.rows):
            row = self.coach[i]
            consecutive_seats = 0
            for j in range(self.seats_per_row):
                if row[j] == 0:
                    consecutive_seats += 1
                    if consecutive_seats == num_seats:
                        # Book seats in this row
                        for k in range(j - num_seats + 1, j + 1):
                            row[k] = 1
                            seat_num = i * self.seats_per_row + k + 1
                            seats_booked.append(seat_num)
                        self.booked_seats.extend(seats_booked)
                        return seats_booked
                else:
                    consecutive_seats = 0
        # If seats are not available in one row then book nearby seats
        for i in range(self.rows):
            row = self.coach[i]
            seats_booked = []
            for j in range(self.seats_per_row):
                if row[j] == 0:
                    row[j] = 1
                    seat_num = i * self.seats_per_row + j + 1
                    seats_booked.append(seat_num)
                    self.booked_seats.extend(seats_booked)
                    return seats_booked
        # If no seats are available, return empty list
        return seats_booked

    def display_coach(self):
        for i in range(self.rows):
            row = self.coach[i]
            row_str = ""
            for j in range(self.seats_per_row):
                if row[j] == 0:
                    row_str += "O "
                else:
                    row_str += "X "
            print(row_str)

coach = TrainCoach(10, 7) # Create a coach with 10 rows and 7 seats per row

