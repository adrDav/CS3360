module Board where

--1.
 -- mkBoard: Receives as input an integer n and returns an empty nxn board as the [[Int]] type.
 mkBoard n = mkBoardnxn n n
 mkBoardnxn n nn = [[0|x<-[1..n]]|x<-[1..nn]]

 -- mkPlayer: Object of type Int, mkPlayer represents the human player.
 mkPlayer :: Int
 mkPlayer = 1

 -- mkOpponent: Object of type Int, mkOpponent represents the computer player.
 mkOpponent :: Int
 mkOpponent = 2

 -- size bd: Receives the board ( [[Int]] ) and returns the length of such object.
 size :: [[Int]]-> Int
 size bd =  length bd

 -- row y bd: Receives an integer y, where y represents a 1-based index. Returns the list of coordinates of the row.
 row :: Int -> [[Int]] -> [Int]
 row y bd 
  | y<1 || y>(size bd) = []
  | otherwise = bd !! (y-1)


 -- column x bd: Receives an integer x, where x represents a 1-based index. Returns the list of coordinates of the column.
 column :: Int -> [[Int]] -> [Int]
 column x bd = [a !! (x-1) | a<-bd] 

--2.
 markRow 1 (h:t) p = (m:t)
  where m = if h==0 then p else h
 markRow n (h:t) p = h : markRow (n-1) t p

 -- mark x y bd p: Receives two integers, x and y, along with the board, marks the board with the player´s stone. Returns the marked board.
 mark :: Int -> Int -> [[Int]] -> Int ->[[Int]]
 mark 1 y (h:t) p = markRow y h p : t
 mark x y (h:t) p = h:mark (x-1) y t p

 -- isEmpty x y bd: Receives two integers, x and y, along with the board, returns a boolean stating if there is a stone placed by either player in the location.
 isEmpty :: Int -> Int -> [[Int]] -> Bool
 isEmpty x y bd = ((row y bd) !! (x-1) == 0)

 -- isMarked x y bd: Receives two integers, x and y, along with the board, returns a boolean stating if the location has already a stone placed.
 isMarked :: Int -> Int -> [[Int]] -> Bool
 isMarked x y bd = ((row y bd) !! (x-1) /= 0)

 -- isMarkedBy x y bd p: Receives two integers, x and y, along with the board and the player, returns a boolean stating if the location has already a stone placed by the respective player.
 isMarkedBy :: Int -> Int -> [[Int]] -> Int -> Bool
 isMarkedBy x y bd p = ((row y bd) !! (x-1) == p)

 -- marker x y board: Receives two integers, x and y, along with the board, returns the player stone associated with the player.
 marker :: Int -> Int -> [[Int]] -> Int
 marker x y board = (row y board) !! (x-1)
 
 isFullRow [] = True
 isFullRow (h:t) = h/=0 && isFullRow t
 -- isFull bd: Receives the board and returns a boolean stating whether there´s a space left in the board to place a stone.
 isFull :: [[Int]] -> Bool
 isFull [] = True
 isFull (h:t) = isFull t && isFullRow h



--3.
 -- isWonBy bd p
 isWonBy :: [[Int]] -> Int -> Int -> Int -> Bool
 isWonBy bd p x y = (((verticalRight bd p x (y+1) 0) + (verticalLeft bd p x (y-1) 0)+1) >= 4)
           ||(((horizontalRight bd p (x+1) y 0) + (horizontalLeft bd p (x-1) y 0)+1) >= 4)
           ||(((diagonalRightRHalf bd p (x+1) (y+1) 0) + (diagonalRightLHalf bd p (x-1) (y-1) 0)+1) >= 4)
           ||(((diagonalLeftRHalf bd p (x+1) (y-1) 0) + (diagonalLeftLHalf bd p (x-1) (y+1) 0)+1) >= 4)
 -- isDraw bd: Receives the board and returns a boolean stating if is a draw, based on the board being full.
 isDraw :: [[Int]] -> Bool
 isDraw bd = isFull bd 
 -- isGameOver bd: Receives the board and returns a boolean stating if the game ended, based on the being a draw or being won by either player.
 isGameOver :: [[Int]] -> Bool
 isGameOver bd = isDraw bd
 -- |isWonBy bd 1
 -- |isWonBy bd 2
 
 verticalRight bd p x y col = if y > 0 && y <= (size bd)
                            then 
                             if isMarkedBy x y bd p
                             then verticalRight bd p x (y+1) (col+1)
                             else col
                            else col

 verticalLeft bd p x y col = if y > 0 && y <= (size bd)
                            then 
                             if isMarkedBy x y bd p
                             then verticalLeft bd p x (y-1) (col+1)
                             else col
                            else col

 horizontalRight bd p x y col = if x > 0 && x <= (size bd)
                            then 
                             if isMarkedBy x y bd p
                             then horizontalLeft bd p (x+1) y (col+1)
                             else col
                            else col

 horizontalLeft bd p x y col = if x > 0 && x <= (size bd)
                            then 
                             if isMarkedBy x y bd p
                             then horizontalLeft bd p (x-1) y (col+1)
                             else col
                            else col
 
 diagonalRightRHalf bd p x y col = if y > 0 && y <= (size bd) && x > 0 && x <= (size bd)
                            then 
                             if isMarkedBy x y bd p
                             then diagonalRightRHalf bd p (x+1) (y+1) (col+1)
                             else col
                            else col
 
 diagonalRightLHalf bd p x y col = if y > 0 && y <= (size bd) && x > 0 && x <= (size bd)
                            then 
                             if isMarkedBy x y bd p
                             then diagonalRightLHalf bd p (x-1) (y-1) (col+1)
                             else col
                            else col

 diagonalLeftRHalf bd p x y col = if y > 0 && y <= (size bd) && x > 0 && x <= (size bd)
                            then 
                             if isMarkedBy x y bd p
                             then diagonalLeftRHalf bd p (x+1) (y-1) (col+1)
                             else col
                            else col

 diagonalLeftLHalf bd p x y col = if y > 0 && y <= (size bd) && x > 0 && x <= (size bd)
                            then 
                             if isMarkedBy x y bd p
                             then diagonalLeftLHalf bd p (x-1) (y+1) (col+1)
                             else col
                            else col

 


 -- checkVertical [] p = False
 -- checkVertical bd p 
 -- rowCheckFive 

 
 -- boardToStr playerToChar bd
 boardToStr playerToChar bd = twoDtoStr playerToChar bd (size bd)
 
 twoDtoStr  playerToChar bd 0 = []
 twoDtoStr playerToChar bd c = (twoDtoStr playerToChar bd (c-1)) ++ (rowToStr playerToChar (row c bd)) ++ ['\n']
 
 rowToStr _ [] = []
 rowToStr f (h:t) = f h : rowToStr f t

 playerToChar p =
  case p of
   1 -> 'O'
   2 -> 'X'
   x -> '.'
