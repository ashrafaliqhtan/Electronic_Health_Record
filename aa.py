import random
import numpy as np
import matplotlib.pyplot as plt

# Define the VacuumCleanerWorld environment
class VacuumCleanerWorld:
    def __init__(self, rows, cols):
        self.rows = rows
        self.cols = cols
        # Initialize grid with random dirty (True) and clean (False) cells
        self.grid = [[random.choice([True, False]) for _ in range(cols)] for _ in range(rows)]
        self.agent_pos = [0, 0]  # Starting position of agent at top-left corner
        self.cleaned = 0  # Count of cleaned tiles
    
    def is_dirty(self, x, y):
        """Returns whether the given tile is dirty"""
        return self.grid[x][y]
    
    def clean(self, x, y):
        """Cleans the tile at the given position"""
        if self.is_dirty(x, y):
            self.grid[x][y] = False  # Clean the tile
            self.cleaned += 1  # Increment the number of cleaned tiles
    
    def print_environment(self):
        """Prints the current state of the environment"""
        for row in self.grid:
            print(' '.join(['D' if cell else 'C' for cell in row]))  # D for dirty, C for clean
    
    def get_agent_position(self):
        """Returns the current position of the agent"""
        return self.agent_pos
    
    def plot_environment(self, agent_pos):
        """Visualizes the grid and the agent's position"""
        grid = np.array(self.grid, dtype=int)
        grid[agent_pos[0], agent_pos[1]] = 2  # Mark agent's position on the grid (value 2)
        
        plt.imshow(grid, cmap='winter', interpolation='nearest')
        plt.title(f"Agent at ({agent_pos[0]}, {agent_pos[1]})")
        plt.colorbar(label="Grid State")
        plt.show()

# Define the Simple Reflex Agent
class SimpleReflexAgent:
    def __init__(self, environment):
        self.environment = environment
    
    def move_up(self):
        x, y = self.environment.get_agent_position()
        if x > 0:
            self.environment.agent_pos = [x-1, y]
    
    def move_down(self):
        x, y = self.environment.get_agent_position()
        if x < self.environment.rows - 1:
            self.environment.agent_pos = [x+1, y]
    
    def move_left(self):
        x, y = self.environment.get_agent_position()
        if y > 0:
            self.environment.agent_pos = [x, y-1]
    
    def move_right(self):
        x, y = self.environment.get_agent_position()
        if y < self.environment.cols - 1:
            self.environment.agent_pos = [x, y+1]
    
    def is_dirty(self):
        x, y = self.environment.get_agent_position()
        return self.environment.is_dirty(x, y)
    
    def suck(self):
        x, y = self.environment.get_agent_position()
        if self.is_dirty():
            self.environment.clean(x, y)
    
    def take_action(self):
        x, y = self.environment.get_agent_position()
        
        if self.is_dirty():
            self.suck()  # Clean if dirty
        
        # Randomly choose an action to move
        possible_moves = ['up', 'down', 'left', 'right']
        move = random.choice(possible_moves)
        if move == 'up':
            self.move_up()
        elif move == 'down':
            self.move_down()
        elif move == 'left':
            self.move_left()
        elif move == 'right':
            self.move_right()

# Define the Table-Driven Agent
class TableDrivenAgent:
    def __init__(self, environment, table):
        self.environment = environment
        self.table = table  # Table that dictates actions based on environment state
    
    def take_action(self):
        x, y = self.environment.get_agent_position()
        percept = (x, y, self.environment.is_dirty(x, y))  # Percept is the agent's current position and dirt status
        
        # Look up the action in the table based on the current percept
        action = self.table.get(percept, 'right')  # Default action is 'right' if not in table
        
        # Perform the action (move the agent)
        if action == 'up':
            self.move_up()
        elif action == 'down':
            self.move_down()
        elif action == 'left':
            self.move_left()
        elif action == 'right':
            self.move_right()
    
    def move_up(self):
        x, y = self.environment.get_agent_position()
        if x > 0:
            self.environment.agent_pos = [x-1, y]
    
    def move_down(self):
        x, y = self.environment.get_agent_position()
        if x < self.environment.rows - 1:
            self.environment.agent_pos = [x+1, y]
    
    def move_left(self):
        x, y = self.environment.get_agent_position()
        if y > 0:
            self.environment.agent_pos = [x, y-1]
    
    def move_right(self):
        x, y = self.environment.get_agent_position()
        if y < self.environment.cols - 1:
            self.environment.agent_pos = [x, y+1]

# Performance Measure
def performance_measure(agent, environment):
    return environment.cleaned

# Simulation and Plotting Function
def run_simulation(agent, environment, steps=100):
    cleaned_tiles = []
    
    for step in range(steps):
        agent.take_action()  # Agent performs an action
        cleaned_tiles.append(environment.cleaned)
        
        # Plot the environment at each step
        environment.plot_environment(agent.environment.get_agent_position())
        
        # If all tiles are cleaned, stop the simulation
        if environment.cleaned == environment.rows * environment.cols:
            print(f"Environment cleaned in {step + 1} steps.")
            break
    
    # Evaluate the agent's final performance using the performance measure
    final_score = performance_measure(agent, environment)
    print(f"Final performance score (cleaned tiles): {final_score}")
    
    # Plot the cleaning progress over time
    plt.plot(cleaned_tiles)
    plt.xlabel('Steps')
    plt.ylabel('Cleaned Tiles')
    plt.title('Cleaning Progress over Time')
    plt.show()


# Testing the Simulation
env = VacuumCleanerWorld(5, 5)

# Initialize a Simple Reflex Agent
simple_agent = SimpleReflexAgent(env)
print("Testing Simple Reflex Agent:")
run_simulation(simple_agent, env)

# Testing with Table-Driven Agent
table = {
    (0, 0, True): 'down',  # Example percept-action mappings
    (0, 1, True): 'right',
    (1, 1, True): 'down'
}

table_agent = TableDrivenAgent(env, table)
print("Testing Table-Driven Agent:")
run_simulation(table_agent, env)
